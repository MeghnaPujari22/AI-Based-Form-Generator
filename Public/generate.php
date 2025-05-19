<?php
require_once __DIR__ . '/../secure/config.php';

header("Content-Security-Policy: default-src 'self'");
header("Content-Type: text/html");

$framework = in_array($_POST['framework'] ?? '', ['bootstrap', 'tailwind', 'none']) 
    ? $_POST['framework'] 
    : 'bootstrap';
$prompt = htmlspecialchars($_POST['prompt'] ?? '', ENT_QUOTES, 'UTF-8');

if (empty($prompt)) {
    http_response_code(400);
    exit(json_encode(['error' => 'Please provide a website description']));
}

// Framework-specific instructions
$frameworkInstructions = match($framework) {
    'bootstrap' => "Use Bootstrap 5 with proper container/row/column structure. Include Bootstrap CDN.",
    'tailwind' => "Use Tailwind CSS with CDN. Use flex/grid layout with utility classes.",
    default => "Use plain HTML/CSS with inline styles for basic formatting."
};

$systemPrompt = <<<PROMPT
Generate a complete, responsive HTML5 page based on the user's description.
Requirements:
- {$frameworkInstructions}
- Include proper semantic HTML
- Add comments for main sections
- Include placeholder text where needed
- Make it mobile-friendly
Return ONLY the HTML code with no markdown.
PROMPT;

$data = [
    "model" => "mistralai/mixtral-8x7b-instruct",
    "messages" => [
        ["role" => "system", "content" => $systemPrompt],
        ["role" => "user", "content" => $prompt]
    ],
    "temperature" => 0.3
];

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => "https://openrouter.ai/api/v1/chat/completions",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer " . OPENROUTER_API_KEY,
        "Content-Type: application/json",
        "HTTP-Referer: http://localhost",
        "X-Title: AI Based Form Based Website Generator"
    ]
]);

$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    http_response_code(500);
    exit(json_encode(['error' => "API connection failed: {$error}"]));
}

$result = json_decode($response, true);
echo $result['choices'][0]['message']['content'] ?? json_encode(['error' => 'Invalid API response']);
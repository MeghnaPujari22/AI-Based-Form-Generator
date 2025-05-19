<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚀 AI Form Based Website Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism.min.css" rel="stylesheet">
    <!--<link href="../assets/styles.css" rel="stylesheet">-->
    <style>
        .preview-frame { border: none; height: 500px; }
        .history-item { transition: all 0.2s; }
        .code-block { max-height: 500px; overflow-y: auto; }
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row g-4">
           <div class="col-lg-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h5 mb-0">⚙️ Configuration</h2>
                    </div>
                    <div class="card-body">
                        <form id="generatorForm">
                            <div class="mb-3">
                                <label class="form-label">Framework</label>
                                <select class="form-select" id="framework">
                                    <option value="bootstrap">Bootstrap 5</option>
                                    <option value="tailwind">Tailwind CSS</option>
                                    <option value="none">Plain HTML</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea id="prompt" class="form-control" 
                                          rows="5"
                                          placeholder="Example: Create a portfolio website with a hero section, projects grid, and contact form..."
                                          required></textarea>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <span class="btn-text">Generate</span>
                                    <span class="spinner-border spinner-border-sm d-none"></span>
                                </button>
                                <button type="button" class="btn btn-success" id="downloadBtn">
                                    💾 Download HTML
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card shadow mt-4">
                    <div class="card-header bg-secondary text-white">
                        <h3 class="h6 mb-0">⏳ History</h3>
                    </div>
                    <div class="card-body p-0">
                        <div id="historyList" class="list-group list-group-flush"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="h6 mb-0">👁️ Live Preview</h3>
                    </div>
                    <div class="card-body p-0">
                        <iframe id="preview" class="preview-frame w-100"></iframe>
                    </div>
                </div>

                <div class="card shadow mt-4">
                    <div class="card-header bg-info text-white">
                        <h3 class="h6 mb-0">🖥️ Generated Code</h3>
                    </div>
                    <div class="card-body p-0 code-block">
                        <pre class="m-0"><code id="generatedCode" class="language-html"></code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/prism.min.js"></script>
    <script>
        let currentHtml = '';
        const MAX_HISTORY = 10;
        document.getElementById('generatorForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = {
                framework: document.getElementById('framework').value,
                prompt: document.getElementById('prompt').value
            };

            if (!formData.prompt) {
                alert('Please enter a website description');
                return;
            }

            try {
                toggleLoading(true);
                const response = await fetch('generate.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: new URLSearchParams(formData)
                });

                if (!response.ok) {
                    const error = await response.json();
                    throw new Error(error.error || 'Generation failed');
                }

                currentHtml = await response.text();
                updatePreview(currentHtml);
                updateCodeDisplay(currentHtml);
                addToHistory(formData, currentHtml);
            } catch (error) {
                showError(error.message);
            } finally {
                toggleLoading(false);
            }
        });
        function updatePreview(html) {
            const preview = document.getElementById('preview');
            const doc = preview.contentWindow.document;
            doc.open();
            doc.write(html);
            doc.close();
        }
        function updateCodeDisplay(html) {
            const codeBlock = document.getElementById('generatedCode');
            codeBlock.textContent = html;
            Prism.highlightElement(codeBlock);
        }
        function addToHistory(formData, html) {
            const history = JSON.parse(localStorage.getItem('websiteHistory') || '[]');
            history.unshift({
                ...formData,
                html,
                timestamp: new Date().toISOString()
            });
            
            if (history.length > MAX_HISTORY) history.pop();
            localStorage.setItem('websiteHistory', JSON.stringify(history));
            renderHistory();
        }

        function renderHistory() {
            const history = JSON.parse(localStorage.getItem('websiteHistory') || '[]');
            const historyList = document.getElementById('historyList');
            
            historyList.innerHTML = history.map((item, index) => `
                <div class="list-group-item history-item" 
                     data-html='${JSON.stringify(item.html)}'
                     data-framework='${item.framework}'>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-truncate">${item.prompt}</small>
                        <span class="badge bg-primary">${item.framework}</span>
                    </div>
                    <small class="text-muted">${new Date(item.timestamp).toLocaleString()}</small>
                </div>
            `).join('');

            document.querySelectorAll('.history-item').forEach(item => {
                item.addEventListener('click', () => {
                    document.getElementById('framework').value = item.dataset.framework;
                    document.getElementById('prompt').value = history.find(
                        h => h.timestamp === item.dataset.timestamp
                    ).prompt;
                    currentHtml = JSON.parse(item.dataset.html);
                    updatePreview(currentHtml);
                    updateCodeDisplay(currentHtml);
                });
            });
        }

        // Download Functionality
        document.getElementById('downloadBtn').addEventListener('click', () => {
            if (!currentHtml) return;
            const blob = new Blob([currentHtml], { type: 'text/html' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `generated-website-${Date.now()}.html`;
            a.click();
            URL.revokeObjectURL(url);
        });

        function toggleLoading(isLoading) {
            const btn = document.querySelector('#generatorForm button[type="submit"]');
            btn.querySelector('.btn-text').textContent = isLoading ? 'Generating...' : 'Generate';
            btn.querySelector('.spinner-border').classList.toggle('d-none', !isLoading);
            btn.disabled = isLoading;
        }

        function showError(message) {
            const alert = document.createElement('div');
            alert.className = 'alert alert-danger alert-dismissible fade show mt-3';
            alert.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.querySelector('.container').prepend(alert);
        }
        renderHistory();
    </script>
</body>
</html>

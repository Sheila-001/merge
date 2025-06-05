<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo e($subject); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .code-container {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            overflow-x: auto;
        }
        pre {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            white-space: pre-wrap;
        }
        .language-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <h2>Code Snippet</h2>
    
    <p>Here's the code snippet that was shared with you:</p>
    
    <div class="language-label">Language: <?php echo e(ucfirst($language)); ?></div>
    <div class="code-container">
        <pre><?php echo e($code); ?></pre>
    </div>
    
    <p>This email was sent via the Code Sharing application.</p>
</body>
</html><?php /**PATH C:\Users\PNPh\Desktop\sheila\collab - Copy\resources\views\emails\code.blade.php ENDPATH**/ ?>
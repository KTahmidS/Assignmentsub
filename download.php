<?php
// download.php
if (isset($_GET['file']) && isset($_GET['name'])) {
    $filePath = urldecode($_GET['file']);
    $fileName = urldecode($_GET['name']);
    
    // Security checks
    if (!file_exists($filePath)) {
        die('File not found.');
    }
    
    if (!is_readable($filePath)) {
        die('File not accessible.');
    }
    
    // Prevent directory traversal
    if (strpos($filePath, '..') !== false) {
        die('Invalid file path.');
    }
    
    // Get file extension and set appropriate content type
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $contentTypes = [
        'pdf' => 'application/pdf',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'xls' => 'application/vnd.ms-excel',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'ppt' => 'application/vnd.ms-powerpoint',
        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'txt' => 'text/plain',
        'zip' => 'application/zip'
    ];
    
    $contentType = $contentTypes[$fileExtension] ?? 'application/octet-stream';
    
    // Set headers for download
    header('Content-Description: File Transfer');
    header('Content-Type: ' . $contentType);
    header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));
    
    // Clear output buffer
    ob_clean();
    flush();
    
    // Read the file and output it to the browser
    readfile($filePath);
    exit;
} else {
    header("HTTP/1.0 400 Bad Request");
    die('Invalid request.');
}
?>
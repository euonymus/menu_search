<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>HTML Media Capture Sample</title>
</head>
<body>
    <h1>HTML Media Capture Sample</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="capture" accept="image/*" capture="camera" />
        <input type="submit" value="Upload" />
    </form>
</body>
</html>
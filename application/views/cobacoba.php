<html>
<head>
    <title>EXCEL IMPORT TEST</title>
</head>
<body>
    <h1>EXCEL IMPORT TEST</h1>
    <?php
    echo form_open_multipart('Cobacontroller/import_data');
    echo form_upload('file');
    echo '</br>';
    echo form_submit(null,'Upload');
    echo form_close();
    ?>
</body>
</html>
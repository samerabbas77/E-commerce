<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>لوحة التحكم</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- استدعاء ملفات الـ CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/dist/css/style.css') }}">
</head>
<body>

    <!-- توجيه المستخدم إلى صفحة لوحة التحكم الأساسية -->
    <script>
        window.location.href = "{{ asset('dashboard/dist/pages/index.html') }}";
    </script>

</body>
</html>

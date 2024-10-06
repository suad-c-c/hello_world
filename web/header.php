<html>
<head>
    <!-- عنوان الصفحة في المتصفح -->
    <title>How to Create PHP Crud using OOPS and MySQLi</title>
    <!-- ربط ملف CSS لتنسيق الصفحة -->
    <link href="web/css/styl.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <!-- عنوان رئيسي للصفحة -->
    <h2>How to Create PHP Crud using OOPS and MySQLi</h2>
    
    <!-- قائمة التنقل الرئيسية -->
    <div>
        <ul class="menu-list">
            <!-- رابط يقود إلى صفحة الطلاب -->
            <li><a href="index.php">Student</a></li>
            <!-- رابط يقود إلى صفحة الحضور -->
            <li><a href="index.php?action=attendance">Attendance</a></li>
        </ul>
    </div>
</body>
</html>


<?php
/* 
شرح الكود سطرًا بسطر:
<html>: بداية مستند HTML.
<head>: القسم الذي يحتوي على معلومات ميتا وأي ملفات خارجية مثل CSS أو JavaScript.
<title>How to Create PHP Crud using OOPS and MySQLi</title>: عنوان صفحة HTML الذي سيظهر على علامة التبويب في المتصفح.
<link href="web/css/style.css" type="text/css" rel="stylesheet" />: رابط لاستيراد ملف CSS (الذي يحتوي على تنسيقات الصفحة) من المسار web/css/style.css.
</head>: إغلاق وسم الـhead.
<body>: بداية محتوى صفحة HTML.
<h2>How to Create PHP Crud using OOPS and MySQLi</h2>: عنوان الصفحة يظهر كنص رئيسي بحجم 2 (H2).
<div>: بداية عنصر div يحتوي على قائمة الروابط.
<ul class="menu-list">: إنشاء قائمة غير مرتبة (ul) مع تطبيق الفئة menu-list لتنسيقها باستخدام CSS.
<li><a href="index.php">Student</a></li>: عنصر قائمة (li) يحتوي على رابط يقود إلى صفحة الطلاب (index.php).
<li><a href="index.php?action=attendance">Attendance</a></li>: عنصر قائمة آخر يقود إلى صفحة إدارة الحضور عن طريق تمرير المتغير action=attendance في الرابط.
</ul>: إغلاق القائمة غير المرتبة.
</div>: إغلاق div.

الشرح العام:
هذه الصفحة بسيطة وتحتوي على قائمة تنقل تتضمن رابطين، أحدهما يقود إلى صفحة إدارة الطلاب والآخر إلى صفحة إدارة الحضور. يتم عرض عنوان رئيسي للصفحة يشرح أن الهدف منها هو تعليم كيفية إنشاء CRUD باستخدام البرمجة الكائنية (OOP) وقاعدة البيانات MySQLi.
*/


?>
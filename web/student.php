<?php require_once "web/header.php"; ?>
<div style="text-align: right; margin: 20px 0px 10px;">
    <a id="btnAddAction" href="index.php?action=student-add">
        <img src="web/image/icon-add.png" />Add Student
    </a>
</div>
<div id="toys-grid">
    <table cellpadding="10" cellspacing="1">
        <thead>
            <tr>
                <th><strong>Student Name</strong></th>
                <th><strong>Age</strong></th>
                <th><strong>Roll Number</strong></th>
                <th><strong>Date of Birth</strong></th>
                <th><strong>Class</strong></th>
                <th><strong>Action</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php
            // التحقق مما إذا كانت نتائج الطلاب غير فارغة
            if (!empty($result)) {
                // حلقة لعرض معلومات كل طالب
                foreach ($result as $k => $v) {
                    ?>
                    <tr>
                        <td><?php echo $result[$k]["name"]; ?></td>
                        <td><?php echo $result[$k]["age"]; ?></td> <!-- اسم الطالب -->
                        <td><?php echo $result[$k]["roll_number"]; ?></td> <!-- الرقم الدراسي -->
                        <td><?php echo $result[$k]["dob"]; ?></td> <!-- تاريخ الميلاد -->
                        <td><?php echo $result[$k]["class"]; ?></td> <!-- الصف -->
                        <td>
                            <a class="btnEditAction" href="index.php?action=student-edit&id=<?php echo $result[$k]["id"]; ?>">
                                <img src="web/image/icon-edit.png" /> <!-- أيقونة التعديل -->
                            </a>
                            <a class="btnDeleteAction" href="index.php?action=student-delete&id=<?php echo $result[$k]["id"]; ?>">
                                <img src="web/image/icon-delete.png" /> <!-- أيقونة الحذف -->
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php

/*شرح الكود سطرًا بسطر:
<?php require_once "web/header.php"; ?>: تضمين ملف الرأس الذي يحتوي على العناصر العامة مثل العنوان وأوراق الأنماط.

<div style="text-align: right; margin: 20px 0px 10px;">: إنشاء عنصر div لتنسيق زر "إضافة طالب" بحيث يكون محاذيًا إلى اليمين.

<a id="btnAddAction" href="index.php?action=student-add"><img src="web/image/icon-add.png" />Add Student</a>:

رابط لإضافة طالب جديد، يحتوي على صورة رمز إضافة.
عند النقر على الرابط، يتم توجيه المستخدم إلى الصفحة المخصصة لإضافة طالب.
<div id="toys-grid">: بدء عنصر div الذي سيحتوي على جدول الطلاب.

<table cellpadding="10" cellspacing="1">: بدء جدول HTML.

<thead>: بدء رأس الجدول.

<tr>: بدء صف الرأس.

<th><strong>Student Name</strong></th>: عمود لاسم الطالب.

<th><strong>Roll Number</strong></th>: عمود للرقم الدراسي.

<th><strong>Date of Birth</strong></th>: عمود لتاريخ الميلاد.

<th><strong>Class</strong></th>: عمود للصف.

<th><strong>Action</strong></th>: عمود للإجراءات الممكنة (مثل التعديل أو الحذف).

</tr>: إغلاق صف الرأس.

</thead>: إغلاق رأس الجدول.

<tbody>: بدء جسم الجدول.

<?php if (! empty($result)) {...}: إذا كانت نتائج الطلاب غير فارغة، ابدأ حلقة لعرض كل طالب.

foreach ($result as $k => $v) {...}: حلقة تكرارية للمرور عبر نتائج الطلاب.

<tr>: بدء صف جديد لتمثيل طالب.

<td><?php echo $result[$k]["name"]; ?></td>: عرض اسم الطالب في عمود.

<td><?php echo $result[$k]["roll_number"]; ?></td>: عرض الرقم الدراسي في عمود.

<td><?php echo $result[$k]["dob"]; ?></td>: عرض تاريخ الميلاد في عمود.

<td><?php echo $result[$k]["class"]; ?></td>: عرض الصف في عمود.

<td><a class="btnEditAction" href="index.php?action=student-edit&id=<?php echo $result[$k]["id"]; ?>">:

رابط لتحرير بيانات الطالب.
يتم تضمين معرّف الطالب في الرابط لتمريره إلى صفحة التعديل.
<img src="web/image/icon-edit.png" />: أيقونة التعديل.

</a>: إغلاق رابط التعديل.

<a class="btnDeleteAction" href="index.php?action=student-delete&id=<?php echo $result[$k]["id"]; ?>">:

رابط لحذف الطالب.
يتم تضمين معرّف الطالب في الرابط.
<img src="web/image/icon-delete.png" />: أيقونة الحذف.

</a>: إغلاق رابط الحذف.

</td>: إغلاق عمود الإجراءات.

</tr>: إغلاق صف الطالب.

<?php } } ?>: إغلاق الحلقة والشروط.

</tbody>: إغلاق جسم الجدول.

</table>: إغلاق الجدول.

</div>: إغلاق عنصر div الذي يحتوي على الجدول.

</body>: إغلاق عنصر body.

</html>: إغلاق مستند HTML.

الشرح العام:
هذا الكود يقوم بإنشاء جدول لعرض معلومات الطلاب. يتضمن أسماء الطلاب، أرقامهم الدراسية، تواريخ ميلادهم، وصفوفهم، بالإضافة إلى إجراءات للتعديل أو الحذف لكل طالب. عند الضغط على زر "Add Student"، يتم توجيه المستخدم إلى صفحة لإضافة طالب جديد.

*/

?>
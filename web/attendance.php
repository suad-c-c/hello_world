<?php require_once "web/header.php"; // استدعاء ملف الهيدر ?>

<!-- رابط لإضافة حضور جديد -->
<div style="text-align: right; margin: 20px 0px 10px;">
    <a id="btnAddAction" href="index.php?action=attendance-add"><img src="web/image/icon-add.png" />Add Attendance</a>
</div>

<!-- جدول لعرض سجلات الحضور -->
<div id="toys-grid">
    <table cellpadding="10" cellspacing="1" class="attendance_table">
        <thead>
            <tr>
                <th><strong>Date</strong></th>
                <th><strong>Present</strong></th>
                <th><strong>Late</strong></th>
                <th><strong>Absent</strong></th>
                <th><strong>Action</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php
            // التحقق مما إذا كانت هناك بيانات متاحة في المتغير $result
            if (!empty($result)) {
                // حلقة لعرض كل سجل من سجلات الحضور
                foreach ($result as $k => $v) {
                    ?>
                    <tr>
                        <!-- معالجة التاريخ وتحويله من طابع زمني إلى صيغة MM-DD-YYYY -->
                        <td><?php 
                        $attendance_date = "";
                        if (!empty($result[$k]["attendance_date"])) {
                            $attendance_timestamp = strtotime($result[$k]["attendance_date"]);
                            $attendance_date = date("m-d-Y", $attendance_timestamp);
                        }
                        echo $attendance_date; ?></td>
                        
                        <!-- عرض عدد الحاضرين -->
                        <td><?php echo $result[$k]["present"]; ?></td>

                        <td><?php echo $result[$k]["late"]; ?></td>

                        <!-- عرض عدد الغائبين -->
                        <td><?php echo $result[$k]["absent"]; ?></td>
                        
                        <!-- روابط تعديل وحذف سجل الحضور -->
                        <td>
                            <a class="btnEditAction"
                               href="index.php?action=attendance-edit&date=<?php echo $result[$k]["attendance_date"]; ?>">
                                <img src="web/image/icon-edit.png" />
                            </a>
                            <a class="btnDeleteAction" 
                               href="index.php?action=attendance-delete&date=<?php echo $result[$k]["attendance_date"]; ?>">
                                <img src="web/image/icon-delete.png" />
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        <tbody>
    </table>
</div>
</body>
</html>

<?php
/*

شرح الكود سطرًا بسطر:
<?php require_once "web/header.php"; ?>: استدعاء ملف الهيدر "header.php" الذي قد يحتوي على إعدادات عامة أو الروابط إلى ملفات CSS وJavaScript المشتركة.

<div style="text-align: right; margin: 20px 0px 10px;">: إنشاء div يحتوي على زر لإضافة سجل جديد لحضور الطلاب، وتحديد اتجاه النص إلى اليمين مع بعض المسافات العلوية والسفلية.

<a id="btnAddAction" href="index.php?action=attendance-add"><img src="web/image/icon-add.png" />Add Attendance</a>: رابط يؤدي إلى صفحة إضافة حضور جديد. يحتوي الرابط على صورة أيقونة إضافة.

<div id="toys-grid">: بداية div لعرض الجدول الخاص بسجلات الحضور.

<table cellpadding="10" cellspacing="1" class="attendance_table">: إنشاء جدول يحتوي على معلومات الحضور بتنسيق داخلي (المسافة بين الخلايا والحدود الداخلية)، مع تطبيق الفئة attendance_table لتنسيق الجدول.

<thead>: رأس الجدول الذي يحتوي على أسماء الأعمدة.

<th><strong>Date</strong></th><th><strong>Present</strong></th><th><strong>Absent</strong></th><th><strong>Action</strong></th>: تحديد عناوين الأعمدة وهي: "التاريخ"، "الحاضر"، "الغائب"، و"الإجراءات".

<tbody>: بداية جسم الجدول الذي سيعرض بيانات الحضور.

<?php if (!empty($result)) { foreach ($result as $k => $v) { ?>: تحقق مما إذا كان هناك بيانات حضور متاحة في المتغير $result، ثم يبدأ حلقة foreach لعرض كل سجل.

<td><?php $attendance_date = ""; if(!empty($result[$k]["attendance_date"])) { ... } echo $attendance_date; ?></td>: معالجة تاريخ الحضور وتحويله من الطابع الزمني إلى صيغة "MM-DD-YYYY"، ثم عرضه في العمود.

<td><?php echo $result[$k]["present"]; ?></td>: عرض عدد الحاضرين في العمود الخاص بهم.

<td><?php echo $result[$k]["absent"]; ?></td>: عرض عدد الغائبين في العمود الخاص بهم.

<td><a class="btnEditAction" href="index.php?action=attendance-edit&date=<?php echo $result[$k]["attendance_date"]; ?>">...: رابط يؤدي إلى صفحة تعديل سجل الحضور. يتم تمرير التاريخ في عنوان الرابط (date).

<a class="btnDeleteAction" href="index.php?action=attendance-delete&date=<?php echo $result[$k]["attendance_date"]; ?>">...: رابط يؤدي إلى حذف سجل الحضور. يتم تمرير التاريخ في الرابط.

<?php } } ?>: إغلاق حلقة foreach وإغلاق التحقق الشرطي.

</tbody></table></div>: إغلاق جسم الجدول وdiv.

الشرح العام:
هذا الكود يعرض قائمة بسجلات الحضور التي تم إدخالها سابقًا، مع تواريخ الحضور وعدد الطلاب الحاضرين والغياب. يقدم للمستخدم إمكانية تعديل أو حذف سجل معين من خلال الروابط "Edit" و"Delete" لكل سجل. كما يسمح بإضافة سجل حضور جديد باستخدام الرابط "Add Attendance".

*/

?>
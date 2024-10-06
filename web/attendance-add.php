<?php require_once "web/header.php"; // استدعاء ملف الهيدر ?>

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
    <div>
        <!-- إدخال التاريخ للحضور -->
        <input type="date" name="attendance_date" id="attendance_date" class="demoInputBox"> 
        <!-- رسالة التحقق لحقول التاريخ -->
        <span id="attendance_date-info" class="info"></span>
    </div>
    <div id="toys-grid">
        <!-- إنشاء جدول لعرض الطلاب وإدخال الحضور -->
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th><strong>Student</strong></th>
                    <th><strong>Present</strong></th>
                    <th><strong>Late</strong></th>
                    <th><strong>Absent</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // التحقق مما إذا كانت هناك بيانات طلابية
                if (!empty($studentResult)) {
                    // حلقة لعرض كل طالب
                    foreach ($studentResult as $k => $v) {
                ?>
                <tr>
                    <td>
                        <!-- حفظ معرف الطالب كقيمة مخفية -->
                        <input type="hidden" name="student_id[]" id="student_id" value="<?php echo $studentResult[$k]["id"]; ?>">
                        <!-- عرض اسم الطالب -->
                        <?php echo $studentResult[$k]["name"]; ?>
                    </td>
                    <!-- إدخال راديو لحالة "حاضر" -->
                    <td><input type="radio" name="attendance-<?php echo $studentResult[$k]["id"]; ?>" value="present" checked /></td>

                    <td><input type="radio" name="attendance-<?php echo $studentResult[$k]["id"]; ?>" value="late" checked /></td>
                    <!-- إدخال راديو لحالة "غائب" -->
                    <td><input type="radio" name="attendance-<?php echo $studentResult[$k]["id"]; ?>" value="absent" /></td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
   <div>
        <!-- زر الإرسال لإضافة الحضور -->
        <input type="submit" name="add" id="btnSubmit" value="Add" />
    </div> 
</form>

<!-- تحميل مكتبة jQuery -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
// دالة التحقق من صحة النموذج
function validate() {
    var valid = true;   
    $(".demoInputBox").css('background-color',''); // إعادة لون الخلفية للحقل الافتراضي
    $(".info").html(''); // إخفاء أي رسائل سابقة
    
    // التحقق مما إذا كان حقل التاريخ فارغًا
    if(!$("#attendance_date").val()) {
        // إذا كان فارغًا، عرض رسالة خطأ وتغيير لون الخلفية
        $("#attendance_date-info").html("(required)");
        $("#attendance_date").css('background-color','#FFFFDF');
        valid = false;
    } 
    return valid; // إعادة الحالة (صحيح أو خطأ)
}
</script>
</body>
</html>

<?php

/* 

<?php require_once "web/header.php"; ?>: يتم استدعاء ملف header.php الذي يحتوي على رأس الصفحة، وهو غالبًا ما يضم عناصر مثل ترويسة الصفحة أو الروابط الخاصة بالأنماط والأكواد البرمجية المشتركة.

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">: بداية نموذج HTML لجمع بيانات الحضور. يستخدم هذا النموذج طريقة POST لإرسال البيانات ويتم استدعاء دالة JavaScript validate() عند إرسال النموذج.

<div><input type="date" name="attendance_date" id="attendance_date" class="demoInputBox"> <span id="attendance_date-info" class="info"></span></div>: إدخال تاريخ الحضور باستخدام عنصر input من نوع date. يظهر حقل إدخال النص بجانبه سبان لعرض رسائل التحقق إذا لم يتم إدخال تاريخ.

<div id="toys-grid">: بداية عنصر div الذي يحتوي على الجدول الخاص بالطلاب.

<table cellpadding="10" cellspacing="1">: بداية جدول لإدخال بيانات الحضور مع تنسيق بسيط باستخدام cellpadding وcellspacing.

<thead><tr><th><strong>Student</strong></th><th><strong>Present</strong></th><th><strong>Absent</strong></th></tr></thead>: العناوين الخاصة بأعمدة الجدول (اسم الطالب، حاضر، غائب).

<tbody>: بداية جسم الجدول حيث يتم عرض الطلاب.

<?php if (!empty($studentResult)) { foreach ($studentResult as $k => $v) { ?>: تحقق مما إذا كان هناك نتائج طلاب في المتغير $studentResult، ثم استخدام حلقة foreach لعرض كل طالب.

<tr><td><input type="hidden" name="student_id[]" id="student_id" value = "<?php echo $studentResult[$k]['id']; ?>"> <?php echo $studentResult[$k]['name']; ?></td>: عرض الطالب باستخدام قيمة مخفية hidden تحتوي على معرّف الطالب. يتم عرض اسم الطالب بجوار هذا الحقل المخفي.

<td><input type="radio" name="attendance-<?php echo $studentResult[$k]['id']; ?>" value="present" checked /></td>: إدخال عنصر radio للسماح باختيار "حاضر" كقيمة افتراضية لهذا الطالب.

<td><input type="radio" name="attendance-<?php echo $studentResult[$k]['id']; ?>" value="absent" /></td>: إدخال عنصر radio للسماح باختيار "غائب" كبديل.

<?php } } ?>: إنهاء حلقة foreach والتحقق الشرطي.

</tbody></table></div>: إغلاق tbody، الجدول وdiv.

<div><input type="submit" name="add" id="btnSubmit" value="Add" /></div>: زر إرسال لإرسال النموذج.

</form>: إغلاق نموذج HTML.

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>: تحميل مكتبة jQuery.

<script>function validate() { ... }</script>: دالة JavaScript للتحقق من صحة النموذج. تتأكد من أن حقل إدخال التاريخ قد تم تعبئته. إذا لم يتم تعبئته، يتم عرض رسالة خطأ وتغيير لون الخلفية إلى اللون الأصفر.

</body></html>: إغلاق صفحة HTML.


*/



?>


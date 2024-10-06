<?php require_once "web/header.php"; // استدعاء ملف الهيدر ?>

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
    <div>
    <?php 
        // تحويل تاريخ الحضور إلى طابع زمني وتنسيقه بصيغة MM-DD-YYYY
        $attendance_timestamp = strtotime($attendance_date);
        $attendance_date = date("m-d-Y", $attendance_timestamp);
    ?>
        <!-- إدخال التاريخ في حقل غير قابل للتعديل -->
        <input name="attendance_date" id="attendance_date" class="demoInputBox" disabled value="<?php echo $attendance_date; ?>"> 
    </div>
    <div id="toys-grid">
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
                // التحقق مما إذا كانت بيانات الطلاب موجودة
                if (!empty($studentResult)) {
                    // حلقة لعرض كل طالب
                    foreach ($studentResult as $k => $v) {
                        $presentChecked = "";
                        $lateChecked = "";
                        $absentChecked = "";
                        
                        // التحقق من حالة حضور الطالب
                        if($studentResult[$k]["id"] == $result[$k]["student_id"]) {
                            if($result[$k]["present"] == 1) { 
                                $presentChecked = "checked";
                            } else if($result[$k]["absent"] == 1) { 
                                $absentChecked = "checked";
                            }
                        }
                ?>
                <tr>
                    <td>
                        <!-- حفظ معرف الطالب كقيمة مخفية -->
                        <input type="hidden" name="student_id[]" id="student_id" value="<?php echo $studentResult[$k]["id"]; ?>">
                        <!-- عرض اسم الطالب -->
                        <?php echo $studentResult[$k]["name"]; ?>
                    </td>
                    <!-- إدخال عنصر الراديو لحالة "حاضر" -->
                    <td><input type="radio" name="attendance-<?php echo $studentResult[$k]["id"]; ?>" value="present" <?php echo $presentChecked; ?> /></td>

                    <td><input type="radio" name="attendance-<?php echo $studentResult[$k]["id"]; ?>" value="late" checked <?php echo $absentChecked; ?> /></td>
                
                    <!-- إدخال عنصر الراديو لحالة "غائب" -->
                    <td><input type="radio" name="attendance-<?php echo $studentResult[$k]["id"]; ?>" value="absent" <?php echo $absentChecked; ?> /></td>
                </tr>
                <?php
                    }
                }
                ?>
            <tbody>
        </table>
    </div>
   <div>
        <!-- زر الإرسال لحفظ بيانات الحضور -->
        <input type="submit" name="add" id="btnSubmit" value="Save" />
    </div> 
</form>

<!-- تحميل مكتبة jQuery -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

<script>
// دالة التحقق من صحة النموذج
function validate() {
    var valid = true;   
    $(".demoInputBox").css('background-color',''); // إعادة لون الحقل إلى الافتراضي
    $(".info").html(''); // إخفاء رسائل التحقق
    
    // التحقق مما إذا كان حقل التاريخ فارغًا
    if(!$("#attendance_date").val()) {
        $("#attendance_date-info").html("(required)");
        $("#attendance_date").css('background-color','#FFFFDF');
        valid = false;
    } 
    return valid; // إعادة حالة التحقق (صحيح أو خطأ)
}
</script>
</body>
</html>


<?php


/* شرح الكود سطرًا بسطر:
<?php require_once "web/header.php"; ?>: استدعاء ملف الرأس "header.php" الذي غالبًا يحتوي على إعدادات مشتركة مثل الهيدر أو الروابط إلى ملفات CSS أو JS.

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">: بداية نموذج HTML يقوم بجمع بيانات الحضور. يتم استدعاء دالة JavaScript validate() عند إرسال النموذج للتأكد من أن البيانات المدخلة صالحة.

<?php $attendance_timestamp = strtotime($attendance_date); $attendance_date = date("m-d-Y", $attendance_timestamp); ?>: يتم تحويل متغير attendance_date إلى طابع زمني timestamp ثم يتم تنسيقه ليعرض بصيغة "MM-DD-YYYY".

<input name="attendance_date" id="attendance_date" class="demoInputBox" disabled value="<?php echo $attendance_date; ?>">: إدخال تاريخ الحضور في عنصر input مع إظهاره كحقل غير قابل للتعديل (disabled).

<div id="toys-grid">: بداية div الذي يحتوي على الجدول الخاص بالطلاب.

<table cellpadding="10" cellspacing="1">: إنشاء جدول لإدخال بيانات الحضور مع بعض التنسيق باستخدام المسافة بين الخلايا (cellpadding) والمسافات الداخلية (cellspacing).

<thead><tr><th><strong>Student</strong></th><th><strong>Present</strong></th><th><strong>Absent</strong></th></tr></thead>: ترويسة الجدول التي تحتوي على عناوين الأعمدة: "الطالب"، "حاضر"، "غائب".

<tbody>: بداية جسم الجدول الذي سيعرض تفاصيل كل طالب وحالة حضوره.

<?php if (!empty($studentResult)) { foreach ($studentResult as $k => $v) { ?>: تحقق مما إذا كانت هناك بيانات في المتغير $studentResult، ثم تبدأ حلقة foreach لعرض كل طالب.

<?php $presentChecked = ""; $absentChecked = ""; ?>: يتم تهيئة متغيرات للتحقق مما إذا كان الطالب حاضرًا أم غائبًا.

if($studentResult[$k]["id"] == $result[$k]["student_id"]) {: تحقق مما إذا كانت البيانات في المتغير $result تتطابق مع معرّف الطالب الحالي.

if($result[$k]["present"] == 1) { $presentChecked = "checked"; }: إذا كان الطالب حاضرًا، يتم تعيين قيمة checked للحقل المناسب.

else if($result[$k]["absent"] == 1) { $absentChecked = "checked"; }: إذا كان الطالب غائبًا، يتم تعيين قيمة checked للحقل المناسب.

<tr><td><input type="hidden" name="student_id[]" id="student_id" value = "<?php echo $studentResult[$k]['id']; ?>">: حفظ معرّف الطالب في حقل مخفي.

<?php echo $studentResult[$k]['name']; ?></td>: عرض اسم الطالب بجانب الحقل المخفي.

<td><input type="radio" name="attendance-<?php echo $studentResult[$k]['id']; ?>" value="present" <?php echo $presentChecked; ?> /></td>: إدخال عنصر radio لتحديد حالة الحضور "حاضر".

<td><input type="radio" name="attendance-<?php echo $studentResult[$k]['id']; ?>" value="absent" <?php echo $absentChecked; ?> /></td>: إدخال عنصر radio لتحديد حالة الغياب "غائب".

<?php } } ?>: إغلاق حلقة foreach والتحقق الشرطي.

</tbody></table></div>: إغلاق جسم الجدول وdiv.

<div><input type="submit" name="add" id="btnSubmit" value="Save" /></div>: زر إرسال لحفظ بيانات الحضور.

</form>: إغلاق نموذج HTML.

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>: تحميل مكتبة jQuery.

<script>function validate() { ... }</script>: دالة JavaScript للتأكد من أن الحقول المطلوبة قد تم تعبئتها.

*/

?>
<?php require_once "web/header.php"; ?>

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Name</label> 
        <span id="name-info" class="info"></span><br /> 
        <input type="text" name="name" id="name" class="demoInputBox">
    </div>

    <div>
        <label style="padding-top: 20px;">Age</label> 
        <span id="name-info" class="info"></span><br /> 
        <input type="text" name="age" id="age" class="demoInputBox">
    </div>

    <div>
        <label>Roll Number</label> 
        <span id="roll-number-info" class="info"></span><br /> 
        <input type="text" name="roll_number" id="roll_number" class="demoInputBox">
    </div>
    <div>
        <label>Date of Birth</label> 
        <span id="dob-info" class="info"></span><br />
        <input type="date" name="dob" id="dob" class="demoInputBox">
    </div>
    <div>
        <label>Class</label> 
        <span id="class-info" class="info"></span><br />
        <input type="text" name="class" id="class" class="demoInputBox">
    </div>
    <div>
        <input type="submit" name="add" id="btnSubmit" value="Add" />
    </div>
</form>

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function validate() {
    var valid = true;   
    $(".demoInputBox").css('background-color',''); // إعادة تعيين لون الخلفية
    $(".info").html(''); // إعادة تعيين رسائل المعلومات
    
    // التحقق من صحة البيانات المدخلة
    if(!$("#name").val()) {
        $("#name-info").html("(required)"); // رسالة خطأ للاسم
        $("#name").css('background-color','#FFFFDF'); // تغيير لون الخلفية
        valid = false;
    }
    if(!$("#roll_number").val()) {
        $("#roll-number-info").html("(required)"); // رسالة خطأ للرقم الدراسي
        $("#roll_number").css('background-color','#FFFFDF'); // تغيير لون الخلفية
        valid = false;
    }
    if(!$("#dob").val()) {
        $("#dob-info").html("(required)"); // رسالة خطأ لتاريخ الميلاد
        $("#dob").css('background-color','#FFFFDF'); // تغيير لون الخلفية
        valid = false;
    }
    if(!$("#class").val()) {
        $("#class-info").html("(required)"); // رسالة خطأ للصف
        $("#class").css('background-color','#FFFFDF'); // تغيير لون الخلفية
        valid = false;
    }   
    return valid; // إرجاع قيمة التحقق
}
</script>
</body>
</html>

<?php

/*شرح الكود سطرًا بسطر:
<?php require_once "web/header.php"; ?>: تضمين ملف الرأس، الذي غالبًا ما يحتوي على عناصر HTML العامة مثل العناوين والأوراق الأنماط.

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">: بدء نموذج HTML يُستخدم لإضافة بيانات جديدة. يُحدد أن طريقة الإرسال هي POST، والوظيفة validate() ستُستدعى للتحقق من صحة البيانات المدخلة عند الإرسال.

<div id="mail-status"></div>: عنصر div مخصص لعرض حالة الإرسال (قد يستخدم لعرض رسائل النجاح أو الخطأ).

<div>: بداية عنصر div لتغليف حقول النموذج.

<label style="padding-top: 20px;">Name</label> <span id="name-info" class="info"></span><br /> <input type="text" name="name" id="name" class="demoInputBox">:

عنصر <label> لوصف حقل الاسم.
<span id="name-info" class="info"></span>: عنصر span لعرض رسائل المعلومات (مثل الأخطاء).
<input type="text" name="name" id="name" class="demoInputBox">: حقل إدخال لنص الاسم.
<div>: بداية عنصر div آخر لحقل الرقم الدراسي.

<label>Roll Number</label> <span id="roll-number-info" class="info"></span><br /> <input type="text" name="roll_number" id="roll_number" class="demoInputBox">:

حقل إدخال للرقم الدراسي.
<div>: بداية عنصر div آخر لحقل تاريخ الميلاد.

<label>Date of Birth</label> <span id="dob-info" class="info"></span><br /> <input type="date" name="dob" id="dob" class="demoInputBox">:

حقل إدخال لتاريخ الميلاد، مع نوع إدخال date الذي يظهر تقويمًا لاختيار التاريخ.
<div>: بداية عنصر div آخر لحقل الصف.

<label>Class</label> <span id="class-info" class="info"></span><br /> <input type="text" name="class" id="class" class="demoInputBox">:

حقل إدخال لكتابة الصف.
<div>: بداية عنصر div يحتوي على زر الإرسال.

<input type="submit" name="add" id="btnSubmit" value="Add" />: زر لإرسال النموذج.

</div>: إغلاق div.

</form>: إغلاق النموذج.

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>: استيراد مكتبة jQuery.

<script>: بداية كتلة JavaScript.

function validate() {...}: دالة للتحقق من صحة البيانات المدخلة قبل الإرسال.

var valid = true;: تعيين قيمة المتغير valid كـ true، تشير إلى أن البيانات صحيحة افتراضيًا.
$(".demoInputBox").css('background-color','');: إعادة تعيين خلفية حقول الإدخال.
$(".info").html('');: إعادة تعيين نص المعلومات (الأخطاء).
يتم التحقق من كل حقل إدخال، وإذا كان فارغًا، يتم تحديث نص المعلومات وتغيير لون خلفية الحقل.

return valid;: تعيد الدالة قيمة valid لتحديد ما إذا كان النموذج يجب أن يُرسل أم لا.

</script>: إغلاق كتلة JavaScript.

</body>: إغلاق عنصر body.

</html>: إغلاق مستند HTML. 


الشرح العام:
هذا الكود يقوم بإنشاء نموذج لإضافة بيانات طالب جديد (الاسم، الرقم الدراسي، تاريخ الميلاد، والصف). يتم استخدام JavaScript للتحقق من صحة المدخلات قبل الإرسال، حيث يتم إظهار رسائل خطأ إذا كانت الحقول المطلوبة فارغة.

*/
?>
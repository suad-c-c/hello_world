<?php require_once "web/header.php"; ?>

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Name</label> 
        <span id="name-info" class="info"></span><br /> 
        <input type="text" name="name" id="name" class="demoInputBox" value="<?php echo $result[0]["name"]; ?>">
    </div>

    <div>
        <label style="padding-top: 20px;">Age</label> 
        <span id="name-info" class="info"></span><br /> 
        <input type="text" name="age" id="name" class="demoInputBox" value="<?php echo $result[0]["age"]; ?>">
    </div>


    <div>
        <label>Roll Number</label> 
        <span id="roll-number-info" class="info"></span><br /> 
        <input type="text" name="roll_number" id="roll_number" class="demoInputBox" value="<?php echo $result[0]["roll_number"]; ?>">
    </div>
    <div>
        <label>Date of Birth</label> 
        <span id="dob-info" class="info"></span><br />
        <input type="text" name="dob" id="dob" class="demoInputBox" value="<?php echo $result[0]["dob"]; ?>">
    </div>
    <div>
        <label>Class</label> 
        <span id="class-info" class="info"></span><br />
        <input type="text" name="class" id="class" class="demoInputBox" value="<?php echo $result[0]["class"]; ?>">
    </div>
    <div>
        <input type="submit" name="add" id="btnSubmit" value="Save" />
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
<?php require_once "web/header.php"; ?>: تضمين ملف الرأس الذي يحتوي على العناصر العامة مثل العنوان وأوراق الأنماط.

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">: بدء نموذج HTML لإضافة بيانات الطالب. يتم تعيين طريقة الإرسال إلى POST، ويتم استدعاء دالة validate() للتحقق من صحة البيانات عند الإرسال.

<div id="mail-status"></div>: عنصر div مخصص لعرض حالة الإرسال (مثل رسائل النجاح أو الخطأ).

<div>: بداية عنصر div لتغليف حقول النموذج.

<label style="padding-top: 20px;">Name</label> <span id="name-info" class="info"></span><br /> <input type="text" name="name" id="name" class="demoInputBox" value="<?php echo $result[0]["name"]; ?>">:

عنصر <label> لوصف حقل الاسم.
<span id="name-info" class="info"></span>: عنصر span لعرض رسائل المعلومات (مثل الأخطاء).
<input type="text" name="name" id="name" class="demoInputBox" value="<?php echo $result[0]["name"]; ?>">: حقل إدخال لاسم الطالب، مع تعيين القيمة الافتراضية إلى الاسم الموجود في نتيجة الاستعلام.
<div>: بداية عنصر div آخر لحقل الرقم الدراسي.

<label>Roll Number</label> <span id="roll-number-info" class="info"></span><br /> <input type="text" name="roll_number" id="roll_number" class="demoInputBox" value="<?php echo $result[0]["roll_number"]; ?>">:

حقل إدخال للرقم الدراسي، مع تعيين القيمة الافتراضية إلى الرقم الموجود في نتيجة الاستعلام.
<div>: بداية عنصر div آخر لحقل تاريخ الميلاد.

<label>Date of Birth</label> <span id="dob-info" class="info"></span><br /> <input type="text" name="dob" id="dob" class="demoInputBox" value="<?php echo $result[0]["dob"]; ?>">:

حقل إدخال لتاريخ الميلاد، مع تعيين القيمة الافتراضية إلى تاريخ الميلاد الموجود في نتيجة الاستعلام.
<div>: بداية عنصر div آخر لحقل الصف.

<label>Class</label> <span id="class-info" class="info"></span><br /> <input type="text" name="class" id="class" class="demoInputBox" value="<?php echo $result[0]["class"]; ?>">:

حقل إدخال للصف، مع تعيين القيمة الافتراضية إلى الصف الموجود في نتيجة الاستعلام.
<div>: بداية عنصر div يحتوي على زر الإرسال.

<input type="submit" name="add" id="btnSubmit" value="Save" />: زر لإرسال النموذج.

</div>: إغلاق div.

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
هذا الكود يقوم بإنشاء نموذج لتحرير بيانات طالب موجود. يتم استرداد بيانات الطالب من قاعدة البيانات وملء الحقول بالقيم الحالية. يتم استخدام JavaScript للتحقق من صحة المدخلات قبل الإرسال، حيث يتم إظهار رسائل خطأ إذا كانت الحقول المطلوبة فارغة.

*/

?>
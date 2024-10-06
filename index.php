<?php
// استيراد الفئات اللازمة للتفاعل مع قاعدة البيانات والطلاب والحضور.
require_once("class/DBController.php");
require_once("class/Student.php");
require_once("class/Attendance.php");

// إنشاء كائن للتحكم في قاعدة البيانات.
$db_handle = new DBController();

// تهيئة المتغير للعملية.
$action = "";
// التحقق مما إذا كانت هناك عملية محددة في رابط GET.
if (!empty($_GET["action"])) {
    $action = $_GET["action"]; // تخزين العملية في المتغير.
}

// بدء جملة التبديل لمعالجة العمليات المختلفة.
switch ($action) {
    case "attendance-add":
        // إذا كانت العملية هي "إضافة الحضور".
        if (isset($_POST['add'])) {
            $attendance = new Attendance(); // إنشاء كائن جديد من فئة Attendance.

            // تحويل تاريخ الحضور من نص إلى طابع زمني.
            $attendance_timestamp = strtotime($_POST["attendance_date"]);
            $attendance_date = date("Y-m-d", $attendance_timestamp); // تنسيق التاريخ.

            // التحقق مما إذا كان هناك طلاب محددون.
            if (!empty($_POST["student_id"])) {
                // حذف سجلات الحضور السابقة لهذا التاريخ.
                $attendance->deleteAttendanceByDate($attendance_date);
                // حلقة لإضافة الحضور لكل طالب.
                foreach ($_POST["student_id"] as $k => $student_id) {
                    $present = 0; // تهيئة حالة الحضور.
                    $late = 0;
                    $absent = 0;  // تهيئة حالة الغياب.

                    // تحديد حالة الحضور (حاضر أو غائب).
                    if ($_POST["attendance-$student_id"] == "present") {
                        $present = 1;
                    }
                    
                    else if ($_POST["attendance-$student_id"] == "late") {
                        $late = 1;
                    }
                    
                    else if ($_POST["attendance-$student_id"] == "absent") {
                        $absent = 1;
                    }

                    // إضافة سجل الحضور إلى قاعدة البيانات.
                    $attendance->addAttendance($attendance_date, $student_id, $present,$late,$absent);
                }
            }
            // إعادة توجيه المستخدم إلى صفحة الحضور.
            header("Location: index.php?action=attendance");
        }
        // الحصول على جميع الطلاب لعرضهم في النموذج.
        $student = new Student();
        $studentResult = $student->getAllStudent();
        // تضمين صفحة إضافة الحضور.
        require_once "web/attendance-add.php";
        break;

    case "attendance-edit":
        // إذا كانت العملية هي "تعديل الحضور".
        $attendance_date = $_GET["date"]; // الحصول على تاريخ الحضور من رابط GET.
        $attendance = new Attendance(); // إنشاء كائن جديد من فئة Attendance.

        // التحقق مما إذا كان تم إرسال النموذج لتعديل الحضور.
        if (isset($_POST['add'])) {
            // حذف الحضور السابق.
            $attendance->deleteAttendanceByDate($attendance_date);
            // التحقق مما إذا كان هناك طلاب محددون.
            if (!empty($_POST["student_id"])) {
                // حلقة لتعديل الحضور لكل طالب.
                foreach ($_POST["student_id"] as $k => $student_id) {
                    $present = 0; // تهيئة حالة الحضور.
                    $late = 0;
                    $absent = 0;  // تهيئة حالة الغياب.

                    // تحديد حالة الحضور (حاضر أو غائب).
                    if ($_POST["attendance-$student_id"] == "present") {
                        $present = 1;
                    } 
                    
                    else if ($_POST["attendance-$student_id"] == "late") {
                        $late = 1;
                    }


                    else if ($_POST["attendance-$student_id"] == "absent") {
                        $absent = 1;
                    }

                    // إضافة سجل الحضور إلى قاعدة البيانات.
                    $attendance->addAttendance($attendance_date, $student_id, $present,$late,$absent);
                }
            }
            // إعادة توجيه المستخدم إلى صفحة الحضور.
            header("Location: index.php?action=attendance");
        }

        // الحصول على سجلات الحضور لتاريخ معين.
        $result = $attendance->getAttendanceByDate($attendance_date);

        // الحصول على جميع الطلاب لعرضهم في النموذج.
        $student = new Student();
        $studentResult = $student->getAllStudent();
        // تضمين صفحة تعديل الحضور.
        require_once "web/attendance-edit.php";
        break;

    case "attendance-delete":
        // إذا كانت العملية هي "حذف الحضور".
        $attendance_date = $_GET["date"]; // الحصول على تاريخ الحضور من رابط GET.
        $attendance = new Attendance(); // إنشاء كائن جديد من فئة Attendance.
        // حذف الحضور لهذا التاريخ.
        $attendance->deleteAttendanceByDate($attendance_date);

        // الحصول على جميع سجلات الحضور.
        $result = $attendance->getAttendance();
        // تضمين صفحة الحضور.
        require_once "web/attendance.php";
        break;

    case "attendance":
        // إذا كانت العملية هي عرض الحضور.
        $attendance = new Attendance(); // إنشاء كائن جديد من فئة Attendance.
        // الحصول على جميع سجلات الحضور.
        $result = $attendance->getAttendance();
        // تضمين صفحة الحضور.
        require_once "web/attendance.php";
        break;

    case "student-add":
        // إذا كانت العملية هي "إضافة طالب".
        if (isset($_POST['add'])) {
            // الحصول على بيانات الطالب من النموذج.
            $name = $_POST['name'];
            $age = $_POST['age']; // الحصول على عمر الطالب
            $roll_number = $_POST['roll_number'];
            $dob = "";
            if ($_POST["dob"]) {
                // تحويل تاريخ الميلاد إلى تنسيق مناسب.
                $dob_timestamp = strtotime($_POST["dob"]);
                $dob = date("Y-m-d", $dob_timestamp);
            }
            $class = $_POST['class'];

            // إنشاء كائن جديد من فئة Student.
            $student = new Student();
            // إضافة الطالب إلى قاعدة البيانات.
            $insertId = $student->addStudent($name, $age, $roll_number, $dob, $class);
            // التحقق من نجاح عملية الإضافة.
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record", // رسالة خطأ.
                    "type" => "error"
                );
            } else {
                // إعادة توجيه المستخدم إلى صفحة الطلاب.
                header("Location: index.php");
            }
        }
        // تضمين صفحة إضافة الطالب.
        require_once "web/student-add.php";
        break;

        case "student-edit":
            // إذا كانت العملية هي "تعديل طالب".
            $student_id = $_GET["id"]; // الحصول على معرّف الطالب من رابط GET.
            $student = new Student(); // إنشاء كائن جديد من فئة Student.
        
            // التحقق مما إذا كان تم إرسال النموذج لتعديل الطالب.
            if (isset($_POST['add'])) {
                // الحصول على بيانات الطالب من النموذج.
                $name = $_POST['name'];
                $age = isset($_POST['age']) ? $_POST['age'] : null; // Check if age is set
                $roll_number = $_POST['roll_number'];
                $dob = "";
                if ($_POST["dob"]) {
                    // تحويل تاريخ الميلاد إلى تنسيق مناسب.
                    $dob_timestamp = strtotime($_POST["dob"]);
                    $dob = date("Y-m-d", $dob_timestamp);
                }
                $class = $_POST['class'];
        
                // تعديل معلومات الطالب في قاعدة البيانات.
                $student->editStudent($name, $age, $roll_number, $dob, $class, $student_id);
                // إعادة توجيه المستخدم إلى صفحة الطلاب.
                header("Location: index.php");
            }
        
            // الحصول على معلومات الطالب لتعبئة النموذج.
            $result = $student->getStudentById($student_id);
            // تضمين صفحة تعديل الطالب.
            require_once "web/student-edit.php";
            break;

    case "student-delete":
        // إذا كانت العملية هي "حذف طالب".
        $student_id = $_GET["id"]; // الحصول على معرّف الطالب من رابط GET.
        $student = new Student(); // إنشاء كائن جديد من فئة Student.

        // حذف الطالب من قاعدة البيانات.
        $student->deleteStudent($student_id);

        // الحصول على جميع الطلاب بعد الحذف.
        $result = $student->getAllStudent();
        // تضمين صفحة الطلاب.
        require_once "web/student.php";
        break;

    default:
        // إذا لم تكن هناك حالة متطابقة، عرض جميع الطلاب.
        $student = new Student(); // إنشاء كائن جديد من فئة Student.
        // الحصول على جميع الطلاب.
        $result = $student->getAllStudent();
        // تضمين صفحة الطلاب.
        require_once "web/student.php";
        break;
}




/*

شرح الكود سطرًا بسطر:
هذا الكود عبارة عن سكربت PHP يعالج الإجراءات المختلفة المتعلقة بالطلاب والحضور باستخدام أسلوب البرمجة الكائنية (OOP). إليك الشرح لكل جزء:

require_once ("class/DBController.php");: استيراد فئة التحكم في قاعدة البيانات.

require_once ("class/Student.php");: استيراد فئة الطالب.

require_once ("class/Attendance.php");: استيراد فئة الحضور.

$db_handle = new DBController();: إنشاء كائن جديد من فئة DBController للتفاعل مع قاعدة البيانات.

$action = "";: تهيئة متغير $action.

if (! empty($_GET["action"])) { $action = $_GET["action"]; }: التحقق مما إذا كانت هناك عملية (action) في رابط GET وتخزينها في المتغير $action.

switch ($action) {: بدء جملة التبديل (switch) لمعالجة العمليات المختلفة بناءً على قيمة $action.

حالات العمليات المختلفة:
حالة "attendance-add":
case "attendance-add":: إذا كانت العملية هي "إضافة الحضور".

if (isset($_POST['add'])) {: التحقق مما إذا تم إرسال النموذج.

$attendance = new Attendance();: إنشاء كائن جديد من فئة Attendance.

$attendance_timestamp = strtotime($_POST["attendance_date"]);: تحويل تاريخ الحضور من صيغة نصية إلى طابع زمني.

$attendance_date = date("Y-m-d", $attendance_timestamp);: تنسيق التاريخ إلى الصيغة المطلوبة.

if(!empty($_POST["student_id"])) {: التحقق مما إذا كان هناك طلاب محددون.

$attendance->deleteAttendanceByDate($attendance_date);: حذف أي سجلات موجودة سابقًا لهذا التاريخ.

foreach($_POST["student_id"] as $k=> $student_id) {...}: حلقة تكرارية لإضافة الحضور لكل طالب.

header("Location: index.php?action=attendance");: إعادة توجيه المستخدم إلى صفحة الحضور.

$student = new Student();: إنشاء كائن جديد من فئة Student.

$studentResult = $student->getAllStudent();: الحصول على جميع الطلاب.

require_once "web/attendance-add.php";: تضمين صفحة إضافة الحضور.

حالة "attendance-edit":
case "attendance-edit":: إذا كانت العملية هي "تعديل الحضور".

$attendance_date = $_GET["date"];: الحصول على تاريخ الحضور من رابط GET.

$attendance = new Attendance();: إنشاء كائن جديد من فئة Attendance.

if (isset($_POST['add'])) {...}: التحقق مما إذا تم إرسال النموذج لتعديل الحضور.

$attendance->deleteAttendanceByDate($attendance_date);: حذف الحضور السابق.

foreach($_POST["student_id"] as $k=> $student_id) {...}: حلقة لتعديل الحضور لكل طالب.

header("Location: index.php?action=attendance");: إعادة توجيه المستخدم إلى صفحة الحضور.

$result = $attendance->getAttendanceByDate($attendance_date);: الحصول على سجلات الحضور لهذا التاريخ.

$student = new Student();: إنشاء كائن جديد من فئة Student.

$studentResult = $student->getAllStudent();: الحصول على جميع الطلاب.

require_once "web/attendance-edit.php";: تضمين صفحة تعديل الحضور.

حالة "attendance-delete":
case "attendance-delete":: إذا كانت العملية هي "حذف الحضور".

$attendance_date = $_GET["date"];: الحصول على تاريخ الحضور من رابط GET.

$attendance = new Attendance();: إنشاء كائن جديد من فئة Attendance.

$attendance->deleteAttendanceByDate($attendance_date);: حذف الحضور لهذا التاريخ.

$result = $attendance->getAttendance();: الحصول على جميع سجلات الحضور.

require_once "web/attendance.php";: تضمين صفحة الحضور.

حالة "attendance":
case "attendance":: إذا كانت العملية هي عرض الحضور.

$attendance = new Attendance();: إنشاء كائن جديد من فئة Attendance.

$result = $attendance->getAttendance();: الحصول على جميع سجلات الحضور.

require_once "web/attendance.php";: تضمين صفحة الحضور.

حالة "student-add":
case "student-add":: إذا كانت العملية هي "إضافة طالب".

if (isset($_POST['add'])) {...}: التحقق مما إذا تم إرسال النموذج.

$name = $_POST['name'];: الحصول على اسم الطالب من النموذج.

$roll_number = $_POST['roll_number'];: الحصول على الرقم الدراسي من النموذج.

$dob = ""; if ($_POST["dob"]) {...}: تحويل تاريخ الميلاد إلى تنسيق مناسب.

$class = $_POST['class'];: الحصول على الصف من النموذج.

$student = new Student();: إنشاء كائن جديد من فئة Student.

$insertId = $student->addStudent($name, $roll_number, $dob, $class);: إضافة الطالب إلى قاعدة البيانات.

if (empty($insertId)) {...}: التحقق من نجاح عملية الإضافة.

header("Location: index.php");: إعادة توجيه المستخدم إلى صفحة الطلاب.

require_once "web/student-add.php";: تضمين صفحة إضافة الطالب.

حالة "student-edit":
case "student-edit":: إذا كانت العملية هي "تعديل طالب".

$student_id = $_GET["id"];: الحصول على معرّف الطالب من رابط GET.

$student = new Student();: إنشاء كائن جديد من فئة Student.

if (isset($_POST['add'])) {...}: التحقق مما إذا تم إرسال النموذج.

$student->editStudent($name, $roll_number, $dob, $class, $student_id);: تعديل معلومات الطالب.

header("Location: index.php");: إعادة توجيه المستخدم إلى صفحة الطلاب.

$result = $student->getStudentById($student_id);: الحصول على معلومات الطالب لتعبئة النموذج.

require_once "web/student-edit.php";: تضمين صفحة تعديل الطالب.

حالة "student-delete":
case "student-delete":: إذا كانت العملية هي "حذف طالب".

$student_id = $_GET["id"];: الحصول على معرّف الطالب من رابط GET.

$student = new Student();: إنشاء كائن جديد من فئة Student.

$student->deleteStudent($student_id);: حذف الطالب من قاعدة البيانات.

$result = $student->getAllStudent();: الحصول على جميع الطلاب بعد الحذف.

require_once "web/student.php";: تضمين صفحة الطلاب.

الحالة الافتراضية:
default:: إذا لم تكن هناك حالة متطابقة.

$student = new Student();: إنشاء كائن جديد من فئة Student.

$result = $student->getAllStudent();: الحصول على جميع الطلاب.

require_once "web/student.php";: تضمين صفحة الطلاب.

ملخص:
الكود يتعامل مع CRUD (إنشاء، قراءة، تحديث، حذف) للطلاب وسجلات الحضور. يستخدم أسلوب البرمجة الكائنية لتجميع الوظائف في فئات منفصلة لكل من الطلاب والحضور. يتم التعامل مع كل عملية بناءً على قيمة GET action، مما يسهل فهم الكود وتطويره.
 */
?>
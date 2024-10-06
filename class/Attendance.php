<?php  
// استيراد كلاس DBController للتعامل مع قاعدة البيانات
require_once ("class/DBController.php"); 

// تعريف كلاس Attendance لإدارة الحضور
class Attendance {
    // متغير خاص لتخزين كائن الاتصال بقاعدة البيانات
    private $db_handle;
    
    // المُنشئ يتم استدعاؤه عند إنشاء كائن من هذا الكلاس
    function __construct() {
        // تهيئة كائن DBController
        $this->db_handle = new DBController();
    }
    
    // وظيفة لإضافة الحضور
    function addAttendance($attendance_date, $student_id, $present,$late,$absent) {
        // استعلام لإضافة صف جديد في جدول الحضور
        $query = "INSERT INTO tbl_attendance (attendance_date,student_id,present,late,absent) VALUES (?, ?, ?, ?, ?)";
        // أنواع المتغيرات المستخدمة
        $paramType = "siiii";
        // قيم المتغيرات التي سيتم تمريرها للاستعلام
        $paramValue = array(
            $attendance_date,
            $student_id,
            $present,
            $late,
            $absent
        );
        
        // تنفيذ الاستعلام وإرجاع معرّف الصف المُضاف
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
    // وظيفة لحذف الحضور بناءً على التاريخ
    function deleteAttendanceByDate($attendance_date) {
        // استعلام لحذف الحضور بناءً على التاريخ
        $query = "DELETE FROM tbl_attendance WHERE attendance_date = ?";
        // نوع المتغير المستخدم
        $paramType = "s";
        // قيمة المتغير وهو التاريخ
        $paramValue = array(
            $attendance_date
        );
        // تنفيذ الاستعلام
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    // وظيفة لاسترجاع الحضور بناءً على التاريخ
    function getAttendanceByDate($attendance_date) {
        // استعلام لاسترجاع الحضور مع بيانات الطلاب
        $query = "SELECT * FROM tbl_attendance LEFT JOIN tbl_student ON tbl_attendance.student_id = tbl_student.id WHERE attendance_date = ? ORDER By student_id";
        // نوع المتغير المستخدم
        $paramType = "s";
        // قيمة المتغير وهو التاريخ
        $paramValue = array(
            $attendance_date
        );
        
        // تنفيذ الاستعلام واسترجاع النتائج
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    // وظيفة لاسترجاع جميع الحضور
    function getAttendance() {
        // استعلام لاسترجاع الحضور مع جمع البيانات
        $sql = "SELECT id, attendance_date, sum(present) as present, sum(late) as late ,sum(absent) as absent FROM tbl_attendance GROUP By attendance_date";
        // تنفيذ الاستعلام
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}


/* شرح الكود سطرًا بسطر:
<?php: بداية كود PHP.
 class Attendance {: تعريف كلاس Attendance الذي سيحتوي على الوظائف المتعلقة بالحضور.
private $db_handle;: تعريف متغير خاص db_handle لتخزين كائن الاتصال بقاعدة البيانات.
function __construct() {: تعريف دالة المُنشئ __construct، والتي تُنفذ عند إنشاء كائن من هذا الكلاس.
$this->db_handle = new DBController();: إنشاء كائن من كلاس DBController وحفظه في المتغير db_handle لاستخدامه في العمليات التي تحتاج قاعدة البيانات.
function addAttendance($attendance_date, $student_id, $present, $absent) {: تعريف دالة addAttendance التي تضيف حضور طالب إلى قاعدة البيانات.
$query = "INSERT INTO tbl_attendance (attendance_date,student_id,present,absent) VALUES (?, ?, ?, ?)";: إعداد استعلام لإضافة صف جديد إلى جدول الحضور tbl_attendance.
$paramType = "siii";: تحديد أنواع المتغيرات المستخدمة في الاستعلام (s للسلاسل النصية وi للأعداد الصحيحة).
$paramValue = array($attendance_date, $student_id, $present, $absent);: إعداد قيم المتغيرات التي سيتم تمريرها للاستعلام.
$insertId = $this->db_handle->insert($query, $paramType, $paramValue);: تنفيذ الاستعلام باستخدام دالة insert في كلاس DBController وإرجاع معرّف الصف المُضاف.
return $insertId;: إعادة معرّف الصف المُضاف.
function deleteAttendanceByDate($attendance_date) {: تعريف دالة deleteAttendanceByDate التي تحذف الحضور بناءً على التاريخ.
$query = "DELETE FROM tbl_attendance WHERE attendance_date = ?";: إعداد استعلام لحذف الحضور بناءً على التاريخ.
$paramType = "s";: نوع المتغير المستخدم (سلسلة نصية).
$paramValue = array($attendance_date);: تحديد قيمة المتغير وهو التاريخ.
$this->db_handle->update($query, $paramType, $paramValue);: تنفيذ الاستعلام باستخدام دالة update في كلاس DBController.
function getAttendanceByDate($attendance_date) {: تعريف دالة getAttendanceByDate التي تسترجع الحضور بناءً على التاريخ.
$query = "SELECT * FROM tbl_attendance LEFT JOIN tbl_student ON tbl_attendance.student_id = tbl_student.id WHERE attendance_date = ? ORDER By student_id";: استعلام لاسترجاع جميع الحضور المتعلق بتاريخ معين مع الانضمام إلى جدول الطلاب.
$paramType = "s";: نوع المتغير المستخدم (سلسلة نصية).
$paramValue = array($attendance_date);: تحديد قيمة المتغير وهو التاريخ.
$result = $this->db_handle->runQuery($query, $paramType, $paramValue);: تنفيذ الاستعلام باستخدام دالة runQuery واسترجاع النتائج.
return $result;: إعادة النتائج المسترجعة.
function getAttendance() {: تعريف دالة getAttendance التي تسترجع جميع الحضور.
$sql = "SELECT id, attendance_date, sum(present) as present, sum(absent) as absent FROM tbl_attendance GROUP By attendance_date";: استعلام لجمع الحضور والإجابات حسب التاريخ.
$result = $this->db_handle->runBaseQuery($sql);: تنفيذ الاستعلام باستخدام دالة runBaseQuery.
return $result;: إعادة النتائج المسترجعة.
}: إغلاق الكلاس.
?>: نهاية كود PHP.*/

?>


<?php 
// استيراد ملف DBController للتعامل مع قاعدة البيانات
require_once ("class/DBController.php");

// تعريف كلاس Student لإدارة بيانات الطلاب
class Student
{
    private $db_handle; // متغير للتعامل مع قاعدة البيانات
    
    // المُنشئ يتم استدعاؤه عند إنشاء كائن جديد من هذا الكلاس
    function __construct() {
        $this->db_handle = new DBController(); // إنشاء كائن من DBController
    }
    
    // دالة لإضافة طالب جديد
    function addStudent($name, $age, $roll_number, $dob, $class) {
        // استعلام SQL لإدخال بيانات الطالب
        $query = "INSERT INTO tbl_student (name, age, roll_number, dob, class) VALUES (?, ?, ?, ?, ?)";
        $paramType = "siiss"; // تحديد نوع المعلمات
        $paramValue = array(
            $name, // الاسم
            $age,  // العمر
            $roll_number, // رقم اللف
            $dob, // تاريخ الميلاد
            $class // الصف
        );
        
        // تنفيذ الاستعلام وإرجاع معرّف الصف المُضاف
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
    // دالة لتعديل بيانات طالب موجود
    function editStudent($name, $age, $roll_number, $dob, $class, $student_id) {
        // استعلام SQL لتعديل بيانات الطالب
        $query = "UPDATE tbl_student SET name = ?, age = ?, roll_number = ?, dob = ?, class = ? WHERE id = ?";
        $paramType = "siissi"; // تحديد نوع المعلمات
        $paramValue = array(
            $name, // الاسم
            $age,  // العمر
            $roll_number, // رقم اللف
            $dob, // تاريخ الميلاد
            $class, // الصف
            $student_id // معرّف الطالب
        );
        
        // تنفيذ الاستعلام
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    // دالة لحذف طالب من قاعدة البيانات
    function deleteStudent($student_id) {
        // استعلام SQL لحذف الطالب
        $query = "DELETE FROM tbl_student WHERE id = ?";
        $paramType = "i"; // تحديد نوع المعلمات
        $paramValue = array(
            $student_id // معرّف الطالب
        );
        
        // تنفيذ استعلام الحذف
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    // دالة لجلب بيانات طالب معين باستخدام معرّفه
    function getStudentById($student_id) {
        // استعلام SQL لجلب بيانات الطالب
        $query = "SELECT * FROM tbl_student WHERE id = ?";
        $paramType = "i"; // تحديد نوع المعلمات
        $paramValue = array(
            $student_id // معرّف الطالب
        );
        
        // تنفيذ استعلام جلب البيانات
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    // دالة لجلب جميع بيانات الطلاب
    function getAllStudent() {
        // استعلام SQL لجلب جميع بيانات الطلاب
        $sql = "SELECT * FROM tbl_student ORDER BY id";
        
        // تنفيذ الاستعلام وإرجاع النتائج
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
/* 

شرح الكود سطرًا بسطر:
<?php: بداية كود PHP.
require_once ("class/DBController.php");: استيراد ملف DBController.php، الذي يحتوي على دوال للتعامل مع قاعدة البيانات.
class Student: تعريف كلاس Student الذي يحتوي على وظائف لإدارة بيانات الطلاب.
{: بداية محتوى الكلاس.
private $db_handle;: تعريف متغير خاص db_handle لتخزين الكائن الذي يتعامل مع قاعدة البيانات.
function __construct() {: تعريف دالة المُنشئ التي تُنفذ عند إنشاء كائن جديد من الكلاس.
$this->db_handle = new DBController();: إنشاء كائن جديد من كلاس DBController وتخزينه في المتغير db_handle للتعامل مع قاعدة البيانات.
}: إغلاق دالة المُنشئ.
function addStudent($name, $roll_number, $dob, $class) {: تعريف دالة addStudent لإضافة طالب جديد إلى قاعدة البيانات.
$query = "INSERT INTO tbl_student (name,roll_number,dob,class) VALUES (?, ?, ?, ?)";: إنشاء استعلام SQL لإدخال بيانات الطالب.
$paramType = "siss";: تحديد أنواع المعلمات التي سيتم تمريرها للاستعلام (string, integer, string, string).
$paramValue = array($name, $roll_number, $dob, $class);: إنشاء مصفوفة تحتوي على القيم التي سيتم إدراجها في الاستعلام.
$insertId = $this->db_handle->insert($query, $paramType, $paramValue);: تنفيذ استعلام الإدخال باستخدام دالة insert من DBController وإرجاع معرف الصف المُضاف.
return $insertId;: إرجاع معرّف الطالب المُضاف.
}: إغلاق دالة addStudent.
function editStudent($name, $roll_number, $dob, $class, $student_id) {: تعريف دالة editStudent لتعديل بيانات طالب موجود.
$query = "UPDATE tbl_student SET name = ?,roll_number = ?,dob = ?,class = ? WHERE id = ?";: إنشاء استعلام SQL لتعديل بيانات الطالب.
$paramType = "sissi";: تحديد أنواع المعلمات التي سيتم تمريرها للاستعلام (string, integer, string, string, integer).
$paramValue = array($name, $roll_number, $dob, $class, $student_id);: إنشاء مصفوفة تحتوي على القيم التي سيتم تعديلها.
$this->db_handle->update($query, $paramType, $paramValue);: تنفيذ استعلام التعديل باستخدام دالة update من DBController.
}: إغلاق دالة editStudent.
function deleteStudent($student_id) {: تعريف دالة deleteStudent لحذف طالب من قاعدة البيانات.
$query = "DELETE FROM tbl_student WHERE id = ?";: إنشاء استعلام SQL لحذف طالب.
$paramType = "i";: تحديد نوع المعلمة (integer).
$paramValue = array($student_id);: إنشاء مصفوفة تحتوي على معرّف الطالب الذي سيتم حذفه.
$this->db_handle->update($query, $paramType, $paramValue);: تنفيذ استعلام الحذف باستخدام دالة update من DBController.
}: إغلاق دالة deleteStudent.
function getStudentById($student_id) {: تعريف دالة getStudentById لجلب بيانات طالب معين باستخدام معرّفه.
$query = "SELECT * FROM tbl_student WHERE id = ?";: إنشاء استعلام SQL لجلب بيانات الطالب.
$paramType = "i";: تحديد نوع المعلمة (integer).
$paramValue = array($student_id);: إنشاء مصفوفة تحتوي على معرّف الطالب الذي سيتم جلب بياناته.
$result = $this->db_handle->runQuery($query, $paramType, $paramValue);: تنفيذ استعلام جلب البيانات باستخدام دالة runQuery من DBController.
return $result;: إرجاع البيانات المسترجعة.
}: إغلاق دالة getStudentById.
function getAllStudent() {: تعريف دالة getAllStudent لجلب جميع بيانات الطلاب.
$sql = "SELECT * FROM tbl_student ORDER BY id";: إنشاء استعلام SQL لجلب جميع بيانات الطلاب بترتيب حسب معرّف الطالب.
$result = $this->db_handle->runBaseQuery($sql);: تنفيذ الاستعلام باستخدام دالة runBaseQuery من DBController.
return $result;: إرجاع جميع بيانات الطلاب.
}: إغلاق دالة getAllStudent.
}: إغلاق الكلاس Student.
شرح الكود بالكامل:
Student هو كلاس يحتوي على دوال لإدارة بيانات الطلاب (إضافة، تعديل، حذف، واسترجاع بيانات).
addStudent تضيف طالبًا جديدًا إلى قاعدة البيانات مع الحقول: الاسم، رقم اللف، تاريخ الميلاد، والصف.
editStudent تعدل بيانات طالب موجود بناءً على معرف الطالب.
deleteStudent تحذف طالبًا من قاعدة البيانات باستخدام معرّف الطالب.
getStudentById تسترجع بيانات طالب معين باستخدام معرّفه.
getAllStudent تسترجع جميع بيانات الطلاب مرتبة حسب معرّف الطالب.


*/
?>

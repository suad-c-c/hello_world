<?php
// تعريف كلاس DBController للتعامل مع قاعدة البيانات
class DBController {
    // تعريف بيانات الاتصال بقاعدة البيانات
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "crud_example";
    private $conn;  // متغير لحفظ الاتصال
    
    // المُنشئ يتم استدعاؤه عند إنشاء كائن من هذا الكلاس
    function __construct() {
        // تهيئة الاتصال بقاعدة البيانات
        $this->conn = $this->connectDB();
    }   
    
    // دالة لإنشاء اتصال بقاعدة البيانات
    function connectDB() {
        // استخدام mysqli_connect للاتصال بالخادم وقاعدة البيانات
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        return $conn;
    }
    
    // دالة لتنفيذ استعلام بدون معلمات وإعادة النتائج
    function runBaseQuery($query) {
        // تنفيذ الاستعلام
        $result = $this->conn->query($query);   
        // التحقق من وجود نتائج
        if ($result->num_rows > 0) {
            // حلقة لجلب النتائج
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
            // إعادة النتائج
            return $resultset;
        }        
    }
    
    // دالة لتنفيذ استعلام مع معلمات وإعادة النتائج
    function runQuery($query, $param_type, $param_value_array) {
        // تجهيز الاستعلام
        $sql = $this->conn->prepare($query);
        // ربط المعلمات بالقيم
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        // تنفيذ الاستعلام
        $sql->execute();
        // جلب النتائج
        $result = $sql->get_result();
        
        // التحقق من وجود نتائج
        if ($result->num_rows > 0) {
            // حلقة لجلب النتائج
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        
        // إعادة النتائج إذا كانت موجودة
        if(!empty($resultset)) {
            return $resultset;
        }
    }
    
    // دالة لربط المعلمات بالقيم للاستعلامات المجهزة
    function bindQueryParams($sql, $param_type, $param_value_array) {
        $param_value_reference[] = & $param_type;
        for($i=0; $i<count($param_value_array); $i++) {
            $param_value_reference[] = & $param_value_array[$i];
        }
        // استدعاء bind_param لربط المعلمات بالقيم
        call_user_func_array(array(
            $sql,
            'bind_param'
        ), $param_value_reference);
    }
    
    // دالة لتنفيذ استعلام INSERT وإعادة معرّف الصف المُضاف
    function insert($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $insertId = $sql->insert_id;  // جلب معرّف الصف المُضاف
        return $insertId;
    }
    
    // دالة لتنفيذ استعلام UPDATE لتعديل البيانات
    function update($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
    }
}

/* 


شرح الكود سطرًا بسطر:
<?php: بداية كود PHP.
class DBController {: تعريف كلاس DBController الذي يحتوي على وظائف للتعامل مع قاعدة البيانات.
private $host = "localhost";: تعريف متغير خاص host لتخزين اسم الخادم (في هذه الحالة، localhost).
private $user = "root";: تعريف متغير خاص user لتخزين اسم مستخدم قاعدة البيانات (في هذه الحالة، root).
private $password = "";: تعريف متغير خاص password لتخزين كلمة مرور قاعدة البيانات (فارغة في هذه الحالة).
private $database = "crud_example";: تعريف متغير خاص database لتخزين اسم قاعدة البيانات (في هذه الحالة، crud_example).
private $conn;: تعريف متغير خاص conn لتخزين الاتصال بقاعدة البيانات.
function __construct() {: تعريف دالة المُنشئ التي تُنفذ عند إنشاء كائن من الكلاس.
$this->conn = $this->connectDB();: استدعاء دالة connectDB لتكوين الاتصال بقاعدة البيانات وتخزين النتيجة في المتغير conn.
}: إغلاق دالة المُنشئ.
function connectDB() {: تعريف دالة connectDB التي تنشئ الاتصال بقاعدة البيانات.
$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);: استخدام دالة mysqli_connect لإنشاء الاتصال باستخدام المتغيرات المحددة (الخادم، المستخدم، كلمة المرور، قاعدة البيانات).
return $conn;: إعادة الاتصال الناتج.
}: إغلاق دالة connectDB.
function runBaseQuery($query) {: تعريف دالة runBaseQuery التي تنفذ استعلام SQL دون معلمات مرتبطة.
$result = $this->conn->query($query);: تنفيذ الاستعلام عبر اتصال قاعدة البيانات.
if ($result->num_rows > 0) {: التحقق من أن هناك نتائج للاستعلام.
while($row = $result->fetch_assoc()) {: حلقة تمر عبر النتائج المسترجعة وتحويل كل صف إلى مصفوفة.
$resultset[] = $row;: إضافة كل صف إلى مصفوفة resultset.
}: إغلاق الحلقة.
return $resultset;: إعادة النتائج المسترجعة.
}: إغلاق جملة الشرط.
}: إغلاق دالة runBaseQuery.
function runQuery($query, $param_type, $param_value_array) {: تعريف دالة runQuery لتنفيذ استعلام SQL مع معلمات مرتبطة.
$sql = $this->conn->prepare($query);: تجهيز الاستعلام باستخدام prepare للاستعلام المرسل.
$this->bindQueryParams($sql, $param_type, $param_value_array);: استدعاء دالة bindQueryParams لربط المعلمات بالقيم.
$sql->execute();: تنفيذ الاستعلام.
$result = $sql->get_result();: الحصول على النتائج بعد تنفيذ الاستعلام.
if ($result->num_rows > 0) {: التحقق مما إذا كانت هناك نتائج.
while($row = $result->fetch_assoc()) {: حلقة لقراءة النتائج واسترجاع كل صف كمصفوفة.
$resultset[] = $row;: إضافة كل صف إلى مصفوفة resultset.
}: إغلاق الحلقة.
}: إغلاق جملة الشرط.
if(!empty($resultset)) {: التحقق مما إذا كانت المصفوفة resultset تحتوي على نتائج.
return $resultset;: إعادة النتائج إذا كانت المصفوفة غير فارغة.
}: إغلاق جملة الشرط.
}: إغلاق دالة runQuery.
function bindQueryParams($sql, $param_type, $param_value_array) {: تعريف دالة bindQueryParams لربط المعلمات المرسلة مع الاستعلام.
$param_value_reference[] = & $param_type;: إدراج نوع المعلمات في مصفوفة المرجع.
for($i=0; $i<count($param_value_array); $i++) {: حلقة لتمرير المعلمات إلى مصفوفة المرجع.
$param_value_reference[] = & $param_value_array[$i];: إضافة قيمة المعلمة إلى مصفوفة المرجع.
}: إغلاق الحلقة.
call_user_func_array(array($sql, 'bind_param'), $param_value_reference);: استدعاء دالة bind_param لربط القيم مع المعلمات.
}: إغلاق دالة bindQueryParams.
function insert($query, $param_type, $param_value_array) {: تعريف دالة insert لتنفيذ استعلام إدخال في قاعدة البيانات.
$sql = $this->conn->prepare($query);: تجهيز الاستعلام.
$this->bindQueryParams($sql, $param_type, $param_value_array);: ربط المعلمات مع القيم.
$sql->execute();: تنفيذ الاستعلام.
$insertId = $sql->insert_id;: الحصول على معرّف الصف المُضاف.
return $insertId;: إعادة معرّف الصف المُضاف.
}: إغلاق دالة insert.
function update($query, $param_type, $param_value_array) {: تعريف دالة update لتنفيذ استعلام تعديل في قاعدة البيانات.
$sql = $this->conn->prepare($query);: تجهيز الاستعلام.
$this->bindQueryParams($sql, $param_type, $param_value_array);: ربط المعلمات بالقيم.
$sql->execute();: تنفيذ الاستعلام.
}: إغلاق دالة update.
}: إغلاق الكلاس.
شرح الكود بالكامل:
DBController هو كلاس يستخدم للتعامل مع قاعدة البيانات. يحتوي على بيانات الاتصال بالخادم وطرق لتنفيذ الاستعلامات.
connectDB هي دالة لتوصيل الكلاس بقاعدة البيانات باستخدام بيانات الاتصال.
runBaseQuery تنفذ استعلامات SQL بدون معلمات وتعيد النتائج في شكل مصفوفة.
runQuery تنفذ استعلامات SQL مع معلمات مرتبطة باستخدام prepare وbind_param.
bindQueryParams تربط المعلمات التي تم تمريرها مع الاستعلام المُجهز.
insert تقوم بتنفيذ استعلام INSERT في قاعدة البيانات وتعيد معرّف الصف المُضاف.
update تقوم بتنفيذ استعلام UPDATE لتعديل البيانات في قاعدة البيانات.

*/
?>

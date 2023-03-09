<?php
// 1.Write a PHP function to validate an email address.

function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function checkEmail($str)
{
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

// 2.Write a PHP function to reverse a string without using the built-in function.
function reverseStr($str)
{
    $rev = "";
    $i = 0;
    while (@$str[$i++] != NULL);
    $i--;
    while ($i >= 0) {
        $rev = $rev . @$str[$i--];
    }
    return $rev;
}

// 3.Write a PHP script to find the maximum and minimum value in an array.

// Returns maximum in array
function getMax($array)
{
    $n = count($array);
    $max = $array[0];
    for ($i = 1; $i < $n; $i++)
        if ($max < $array[$i])
            $max = $array[$i];
    return $max;
}

// Returns maximum in array
function getMin($array)
{
    $n = count($array);
    $min = $array[0];
    for ($i = 1; $i < $n; $i++)
        if ($min > $array[$i])
            $min = $array[$i];
    return $min;
}

// 4.Write a PHP function to remove duplicates from an array.

// $inputArray = array('a', 'a', 'c', 'd', 'c', 'a', 'd');

function arrayUnique($inputArray)
{
    $outputArray = array();
    foreach ($inputArray as $inputArrayItem) {
        foreach ($outputArray as $outputArrayItem) {
            if ($inputArrayItem == $outputArrayItem) {
                continue 2;
            }
        }
        $outputArray[] = $inputArrayItem;
    }

    return $outputArray;
}

// 5.Write a PHP script to convert a given date to timestamp.

function timestampGet($date)
{
    return strtotime($date);
}

// 6.Write a PHP script to generate a random password.

function password_generate($chars)
{
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz!@#$%^&*()';
    return substr(str_shuffle($data), 0, $chars);
}
//   echo password_generate(7)."\n";

// 7.Write a PHP function to generate a random string with a given length.

function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
// echo generateRandomString(10);

// 8.Write a PHP script to send an email with attachment.

if (isset($_FILES['attachment'])) {
    $from_email = 'sender@abc.com'; //from mail, sender email address
    $recipient_email = 'recipient@xyz.com'; //recipient email address

    //Load POST data from HTML form
    $sender_name = $_POST["sender_name"]; //sender name
    $reply_to_email = $_POST["sender_email"]; //sender email, it will be used in "reply-to" header
    $subject = $_POST["subject"]; //subject for the email
    $message = $_POST["message"]; //body of the email

    /*Always remember to validate the form fields like this
    if(strlen($sender_name)<1)
    {
        die('Name is too short or empty!');
    }
    */
    //Get uploaded file data using $_FILES array
    $tmp_name = $_FILES['attachment']['tmp_name']; // get the temporary file name of the file on the server
    $name = $_FILES['attachment']['name']; // get the name of the file
    $size = $_FILES['attachment']['size']; // get size of the file for size validation
    $type = $_FILES['attachment']['type']; // get type of the file
    $error = $_FILES['attachment']['error']; // get the error (if any)

    //validate form field for attaching the file
    if ($error > 0) {
        die('Upload error or No files uploaded');
    }

    //read from the uploaded file & base64_encode content
    $handle = fopen($tmp_name, "r"); // set the file handle only for reading the file
    $content = fread($handle, $size); // reading the file
    fclose($handle);                 // close upon completion

    $encoded_content = chunk_split(base64_encode($content));
    $boundary = md5("random"); // define boundary with a md5 hashed value

    //header
    $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
    $headers .= "From:" . $from_email . "\r\n"; // Sender Email
    $headers .= "Reply-To: " . $reply_to_email . "\r\n"; // Email address to reach back
    $headers .= "Content-Type: multipart/mixed;"; // Defining Content-Type
    $headers .= "boundary = $boundary\r\n"; //Defining the Boundary

    //plain text
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= chunk_split(base64_encode($message));

    //attachment
    $body .= "--$boundary\r\n";
    $body .= "Content-Type: $type; name=" . $name . "\r\n";
    $body .= "Content-Disposition: attachment; filename=" . $name . "\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n";
    $body .= "X-Attachment-Id: " . rand(1000, 99999) . "\r\n\r\n";
    $body .= $encoded_content; // Attaching the encoded file with email

    $sentMailResult = mail($recipient_email, $subject, $body, $headers);

    if ($sentMailResult) {
        echo "<h3>File Sent Successfully.<h3>";
        // unlink($name); // delete the file after attachment sent.
    } else {
        die("Sorry but the email could not be sent. Please go back and try again!");
    }
}

// 9.Write a PHP script to fetch data from a MySQL database and display it in a table.

// Username is root
$user = 'root';
$password = '';

// Database name is database
$database = 'database';

// Server is localhost with
// port number 3306
$servername = 'localhost';
$mysqli = new mysqli($servername, $user, $password, $database);

// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
        $mysqli->connect_errno . ') ' .
        $mysqli->connect_error);
}

// SQL query to select data from database
$sql = " SELECT * FROM userdata ORDER BY id DESC ";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<table>
    <tr>
        <th>Filed 1</th>
        <th>Filed 2</th>
        <th>Filed 3</th>
        <th>Filed 4</th>
    </tr>
    <!-- PHP CODE TO FETCH DATA FROM ROWS -->
    <?php
    // LOOP TILL END OF DATA
    while ($rows = $result->fetch_assoc()) {
    ?>
        <tr>
            <!-- FETCHING DATA FROM EACH
            ROW OF EVERY COLUMN -->
            <td><?php echo $rows['filed1']; ?></td>
            <td><?php echo $rows['filed2']; ?></td>
            <td><?php echo $rows['filed3']; ?></td>
            <td><?php echo $rows['filed4']; ?></td>
        </tr>
    <?php
    }
    ?>
</table>

<?php
// 10.Write a PHP script to calculate the factorial of a number.

$num = 6;
function factorialCompute($num, $factorial)
{
    for ($x = $num; $x >= 1; $x--) {
        $factorial = $factorial * $x;
    }

    return $factorial;
}

// echo "Factorial of $num is ". factorialCompute($num, 1);

?>

<?php
// 11.Write a PHP script to implement pagination for a list of records.

$conn = mysqli_connect('localhost', 'root', '');

// root is the default username 

// ' ' is the default password

if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
} else {
    // connect to the database named Pagination
    mysqli_select_db($conn, 'database');
}

// variable to store number of rows per page

$limit = 5;

// query to retrieve all rows from the table userdata

$getQuery = "select *from userdata";

// get the result

$result = mysqli_query($conn, $getQuery);

$total_rows = mysqli_num_rows($result);

// get the required number of pages

$total_pages = ceil($total_rows / $limit);

// update the active page number

if (!isset($_GET['page'])) {
    $page_number = 1;
} else {
    $page_number = $_GET['page'];
}

// get the initial page number

$initial_page = ($page_number - 1) * $limit;

// get data of selected rows per page    

$getQuery = "SELECT *FROM userdata LIMIT " . $initial_page . ',' . $limit;

$result = mysqli_query($conn, $getQuery);

//display the retrieved result on the webpage  

while ($row = mysqli_fetch_array($result)) {
    echo $row['id'] . ' ' . $row['filed1'] . ' ' . $row['filed2'] . ' ' . $row['filed3'] . '</br>';
}

// show page number with link   

for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
    echo '<a href = "index.php?page=' . $page_number . '">' . $page_number . ' </a>';
}

?>

<?php
// 12.Write a PHP script to implement user authentication and authorization using sessions.

// We can difine auth function.
function auth($username, $password)
{
    if ('$username is exist and $password is correct') {
        return true;
    } else {
        return false;
    }
}
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    if (auth($_POST['username'], $_POST['password'])) {
        // auth okay, setup session
        $_SESSION['user'] = $_POST['username'];
        // redirect to required page
        header("Location: index.php");
    } else {
        // didn't auth go back to loginform
        header("Location: ");
    }
} else {
    // username and password not given so go back to login
    header("Location: ");
}

// 13.Write a PHP script to implement file download functionality.

$file = basename($_GET['file']);
$file = '/path/to/your/dir/' . $file;

if (!file_exists($file)) { // file does not exist
    die('file not found');
} else {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");

    // read the file from disk
    readfile($file);
}

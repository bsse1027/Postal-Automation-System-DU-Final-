<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/spl/base_url.php';
include BASE_URL."dbconnect.php"; 
/* Database connection start */
//  echo "test";
if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'getEMP' :
            getEMP($DBconnect);
            break;
        case 'getProd' :
            getProducts($DBconnect);
            break;
        // ...etc...
    }
}

function get_teacher(){
    $query ="SELECT * FROM dept_table WHERE faculty_id = '" . $result_explode[0] . "'";
    $result=mysqli_query($link,$query);

    ?>
    <option value="">Select Department</option>

<?php 
    while($row=mysqli_fetch_array($result)) {?>
    
        <option value="<?php echo $row["dept_id"] ."|". $row["dept_name"]; ?>"><?php echo $row["dept_name"]; ?>
        </option>
    
<?php }
    

}

function getEMP($DBconnect)
{

// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'id',
        1 => 'name',
        2 => 'problem_title'
    );
// getting total number records without any search
    $sql = "SELECT * ";
    $sql .= " FROM tbl_patient_problem_details";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT d.*,p.name from tbl_patient_problem_details d join tbl_patient_details p on (d.patient_id = p.id) WHERE 1=1 and d.doc_id = (select id from tbl_doc_details where user_id=".$_SESSION['user']['id'].")";
    //$sql .= " FROM tbl_patient_problem_details WHERE 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( p.name LIKE '" . $requestData['search']['value'] . "%' )";
       // $sql .= " OR employee_salary LIKE '" . $requestData['search']['value'] . "%' ";
        //$sql .= " OR employee_age LIKE '" . $requestData['search']['value'] . "%' )";
    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");

    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $nestedData = array();
        $nestedData[] = $row["id"];
        $nestedData[] = $row["name"];
        $nestedData[] = $row["problem_title"];
        
        $nestedData[] = "<input type='button' class='btn btn-primary' value='prescribe' onclick= prescribe('".$row["id"]."') />";
        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format


}

//getProducts($DBconnect);
function getProducts($DBconnect)
{
    //  echo "test";

    /* Database connection end */
// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'product_name',
        1 => 'price',
        2 => 'category'
    );
// getting total number records without any search
    $sql = "SELECT product_name, price, category ";
    $sql .= " FROM products";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Error in getting : get products");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT product_name, price, category ";
    $sql .= " FROM products WHERE 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( product_name LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR price LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR category LIKE '" . $requestData['search']['value'] . "%' )";
    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Error in getting : get products");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Error in getting : get products");

    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $nestedData = array();
        $nestedData[] = $row["product_name"];
        $nestedData[] = $row["price"];
        $nestedData[] = $row["category"];

        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format

}

<?php
/* ==========================
   KẾT NỐI DATABASE
========================== */
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "v_store";
$table = "item_sale";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("Lỗi kết nối DB: " . $conn->connect_error);
$conn->set_charset("utf8mb4");

/* ==========================
   VALIDATE DỮ LIỆU
========================== */
function validate($data) {
    $err = [];

    if (empty($data["item_code"])) {
        $err["item_code"] = "Item Code bắt buộc nhập.";
    } elseif (!preg_match("/^[A-Za-z0-9 ]+$/", $data["item_code"])) {
        $err["item_code"] = "Item Code không được chứa ký tự đặc biệt.";
    }

    if (empty($data["item_name"])) {
        $err["item_name"] = "Item Name bắt buộc nhập.";
    } elseif (!preg_match("/^[A-Za-z0-9 ]+$/", $data["item_name"])) {
        $err["item_name"] = "Item Name không hợp lệ.";
    }

    if (empty($data["quantity"]) || !is_numeric($data["quantity"])) {
        $err["quantity"] = "Quantity phải là số hợp lệ.";
    }

    if (empty($data["expried_date"])) {
        $err["expried_date"] = "Expired date bắt buộc nhập.";
    }

    return $err;
}

/* ==========================
   XỬ LÝ CRUD
========================== */
$mode = $_GET["mode"] ?? "list";
$id = $_GET["id"] ?? null;
$errors = [];
$form = [];
$message = "";

/* ----- Xử lý FORM POST ----- */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mode = $_POST["mode"];
    $form = $_POST;
    $errors = validate($_POST);

    if (empty($errors)) {
        $item_code = $conn->real_escape_string($_POST["item_code"]);
        $item_name = $conn->real_escape_string($_POST["item_name"]);
        $quantity  = $conn->real_escape_string($_POST["quantity"]);
        $expried   = $conn->real_escape_string($_POST["expried_date"]);
        $note      = $conn->real_escape_string($_POST["note"]);

        if ($mode === "add") {
            $sql = "INSERT INTO $table (item_code, item_name, quantity, expried_date, note)
                    VALUES ('$item_code', '$item_name', '$quantity', '$expried', '$note')";
            $conn->query($sql);
            header("Location: index.php?msg=Đã thêm item thành công!");
            exit;
        }

        if ($mode === "edit") {
            $id = (int) $_POST["id"];
            $sql = "UPDATE $table SET
                    item_code='$item_code',
                    item_name='$item_name',
                    quantity='$quantity',
                    expried_date='$expried',
                    note='$note'
                    WHERE id=$id";
            $conn->query($sql);
            header("Location: index.php?msg=Cập nhật thành công!");
            exit;
        }
    }
}

/* ----- Delete ----- */
if ($mode === "delete" && $id) {
    $conn->query("DELETE FROM $table WHERE id=" . (int)$id);
    header("Location: index.php?msg=Xóa item thành công!");
    exit;
}

/* ----- Edit: lấy dữ liệu ----- */
if ($mode === "edit" && $id && empty($form)) {
    $qr = $conn->query("SELECT * FROM $table WHERE id = " . (int)$id);
    $form = $qr->fetch_assoc();
}

/* ----- Lấy danh sách items ----- */
$items = $conn->query("SELECT * FROM $table ORDER BY id DESC");

$msg = $_GET["msg"] ?? "";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>V_Store - Items (1 File PHP)</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body { background:#f3f5ff; }
    .container { margin-top: 25px; }
    h1 { color:#4b3aff; font-weight:700; }

    .table th { 
        background:#4b7bec; 
        color:white; 
    }
    .btn-add {
        background:#6c5ce7; border:none;
    }
    .btn-save {
        background:#0984e3; border:none;
    }
    .btn-cancel {
        background:#b2bec3; border:none;
    }
</style>

</head>
<body>

<div class="container">

    <h1>V_Store - Items Manager</h1>

    <?php if ($msg): ?>
        <div class="alert alert-info mt-3"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <?php if ($mode === "list"): ?>

        <div class="d-flex justify-content-between mt-4">
            <h3>Danh sách Items</h3>
            <a href="index.php?mode=add" class="btn btn-add text-white">+ Add New</a>
        </div>

        <table class="table table-bordered table-hover mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Code</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Expired</th>
                    <th>Note</th>
                    <th width="120">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($items->num_rows == 0): ?>
                    <tr><td colspan="7" class="text-center">Chưa có dữ liệu</td></tr>
                <?php endif; ?>

                <?php while ($r = $items->fetch_assoc()): ?>
                    <tr>
                        <td><?= $r["id"] ?></td>
                        <td><?= $r["item_code"] ?></td>
                        <td><?= $r["item_name"] ?></td>
                        <td><?= $r["quantity"] ?></td>
                        <td><?= $r["expried_date"] ?></td>
                        <td><?= $r["note"] ?></td>
                        <td>
                            <a href="index.php?mode=edit&id=<?= $r['id'] ?>" class="btn btn-sm btn-primary">Sửa</a>
                            <a onclick="return confirm('Xóa item này?');" 
                               href="index.php?mode=delete&id=<?= $r['id'] ?>" 
                               class="btn btn-sm btn-danger">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    <?php else: ?>

        <h3 class="mt-4"><?= $mode === "add" ? "Thêm Item mới" : "Chỉnh sửa Item" ?></h3>

        <form method="POST" class="mt-3">

            <input type="hidden" name="mode" value="<?= $mode ?>">
            <?php if ($mode === "edit"): ?>
                <input type="hidden" name="id" value="<?= $form['id'] ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label>Item Code *</label>
                <input type="text" name="item_code" maxlength="6"
                       class="form-control <?= isset($errors['item_code'])?'is-invalid':'' ?>"
                       value="<?= htmlspecialchars($form['item_code'] ?? "") ?>">
                <div class="invalid-feedback"><?= $errors['item_code'] ?? "" ?></div>
            </div>

            <div class="mb-3">
                <label>Item Name *</label>
                <input type="text" name="item_name" maxlength="50"
                       class="form-control <?= isset($errors['item_name'])?'is-invalid':'' ?>"
                       value="<?= htmlspecialchars($form['item_name'] ?? "") ?>">
                <div class="invalid-feedback"><?= $errors['item_name'] ?? "" ?></div>
            </div>

            <div class="mb-3">
                <label>Quantity *</label>
                <input type="number" step="0.01" name="quantity"
                       class="form-control <?= isset($errors['quantity'])?'is-invalid':'' ?>"
                       value="<?= htmlspecialchars($form['quantity'] ?? "") ?>">
                <div class="invalid-feedback"><?= $errors['quantity'] ?? "" ?></div>
            </div>

            <div class="mb-3">
                <label>Expired Date *</label>
                <input type="date" name="expried_date"
                       class="form-control <?= isset($errors['expried_date'])?'is-invalid':'' ?>"
                       value="<?= htmlspecialchars($form['expried_date'] ?? "") ?>">
                <div class="invalid-feedback"><?= $errors['expried_date'] ?? "" ?></div>
            </div>

            <div class="mb-3">
                <label>Note</label>
                <input type="text" name="note" maxlength="60" 
                       class="form-control"
                       value="<?= htmlspecialchars($form['note'] ?? "") ?>">
            </div>

            <button class="btn btn-save text-white">Lưu</button>
            <a href="index.php" class="btn btn-cancel text-white">Hủy</a>

        </form>

    <?php endif; ?>

</div>

</body>
</html>


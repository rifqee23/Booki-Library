<!-- edit_member.php -->
<?php include 'templates/header.php'; ?>
<?php include 'db/connection.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit(); // Terminate script execution after the redirect
}
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM members WHERE id = $id");
    $member = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE members SET name='$name', email='$email' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='p-4 text-white bg-green-500 rounded'>Member updated successfully</div>";
    } else {
        echo "<div class='p-4 text-white bg-red-500 rounded'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<div class="flex items-center justify-center w-full h-screen ">

    <div class="p-6 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-2xl">Edit Member</h2>
        <form action="edit_member.php?id=<?php echo $id; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="<?php echo $member['name']; ?>" class="w-full p-2 mt-1 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $member['email']; ?>" class="w-full p-2 mt-1 border border-gray-300 rounded">
            </div>
            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Update Member</button>
        </form>
    </div>
</div>
<?php include 'templates/footer.php'; ?>
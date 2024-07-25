<?php 
include("db_conn.php");
$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $book_title = mysqli_real_escape_string($conn, $_POST['book_title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']); 
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);       
    $p_date = mysqli_real_escape_string($conn, $_POST['p_date']);
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);

    // Prepare SQL statement
    $sql = "UPDATE `books` SET `book_title`=?, `author`=?, `genre`=?, `p_date`=?, `isbn`=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $book_title, $author, $genre, $p_date, $isbn, $id);

    // Execute statement and handle response
    if ($stmt->execute()) {
        header("Location: index.php?msg=Data updated successfully");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center' role='alert'>
                Error: " . $stmt->error . "
              </div>";
    }
    $stmt->close();
}

// Fetch current user data
$sql = "SELECT * FROM `books` WHERE id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl mb-5 text-center">Update book</h2>
<form action="" method="POST">
    <div class="border-b border-gray-900/10 pb-12">
       
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <label for="book_title" class="block text-sm font-medium leading-6 text-gray-900">Book Title</label>
                <div class="mt-2">
                    <input type="text" name="book_title" id="book_title" autocomplete="given-name" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?php echo htmlspecialchars($row['book_title']); ?>">
                </div>
            </div>
            <div class="sm:col-span-3">
                <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Author</label>
                <div class="mt-2">
                    <input type="text" name="author" id="author" autocomplete="family-name" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?php echo htmlspecialchars($row['author']); ?>">
                </div>
            </div>
            <div class="sm:col-span-3">
                <label for="genre" class="block text-sm font-medium leading-6 text-gray-900">Genre</label>
                <div class="mt-2">
                    <select id="genre" name="genre" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="Romance" <?php echo $row['genre'] == 'Romance' ? 'selected' : ''; ?>>Romance</option>
                        <option value="Thriller" <?php echo $row['genre'] == 'Thriller' ? 'selected' : ''; ?>>Thriller</option>
                        <option value="Sci-Fi" <?php echo $row['genre'] == 'Sci-Fi' ? 'selected' : ''; ?>>Sci-Fi</option>
                        <option value="Comedy" <?php echo $row['genre'] == 'Comedy' ? 'selected' : ''; ?>>Comedy</option>
                    </select>
                </div>
            </div>
            <div class="sm:col-span-3">
                <label for="p_date" class="block text-gray-700 font-semibold mb-2">Date</label>
                <input type="date" id="p_date" name="p_date" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?php echo htmlspecialchars($row['p_date']); ?>">
            </div>
            <div class="sm:col-span-full">
                <label for="isbn" class="block text-sm font-medium leading-6 text-gray-900">ISBN</label>
                <div class="mt-2">
                    <input id="isbn" name="isbn" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?php echo htmlspecialchars($row['isbn']); ?>">
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900" onclick="window.location.href='index.php'">Cancel</button>
            <button type="submit" name="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </div>
</form>
</div>
</body>
</html>

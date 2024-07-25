<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl mb-5 text-center">Add New Book</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $book_title = mysqli_real_escape_string($conn, $_POST['book_title']);
            $author = mysqli_real_escape_string($conn, $_POST['author']); 
            $genre = mysqli_real_escape_string($conn, $_POST['genre']);       
            $p_date = mysqli_real_escape_string($conn, $_POST['p_date']);
            $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);

            $sql = 'INSERT INTO `books` (`book_title`, `author`, `genre`, `p_date`, `isbn`) VALUES (?, ?, ?, ?, ?)';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $book_title, $author, $genre, $p_date, $isbn);

            if ($stmt->execute()) {
                header("Location: index.php?msg=New record created successfully");
                exit();
            } else {
                echo "<div class='bg-red-100 text-red-700 p-4 mb-4 rounded-lg text-center'>
                        Error: " . $stmt->error . "
                      </div>";
            }
            $stmt->close();
        }
        $conn->close();
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">New Book</h2>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="book_title" class="block text-sm font-medium leading-6 text-gray-900">Book Title</label>
                        <div class="mt-2">
                            <input type="text" name="book_title" id="book_title" autocomplete="given-name" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="author" class="block text-sm  font-medium leading-6 text-gray-900">Author</label>
                        <div class="mt-2">
                            <input type="text" name="author" id="author" autocomplete="family-name" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="genre" class="block text-sm  font-medium leading-6 text-gray-900">Genre</label>
                        <div class="mt-2">
                            <select id="genre" name="genre" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option  class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="Romance">Romance</option>
                                <option value="Thriller">Thriller</option>
                                <option value="Sci-Fi">Sci-Fi</option>
                                <option value="Comedy">Comedy</option>
                            </select>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="p_date" class="block text-gray-700 font-semibold mb-2">Date</label>
                        <input type="date" id="p_date" name="p_date" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    <div class="sm:col-span-full">
                        <label for="isbn" class="block text-sm font-medium leading-6 text-gray-900">ISBN</label>
                        <div class="mt-2">
                            <input id="isbn" name="isbn" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900"  onclick="window.location.href='index.php'">Cancel</button>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

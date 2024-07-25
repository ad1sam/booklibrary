<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
  




  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard</h1>
    </div>
  </header>
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <?php
        // Display messages from GET parameter
        if (isset($_GET['msg'])) {
            echo '<div class="mb-5" role="alert">'
                    . htmlspecialchars($_GET['msg']) .
                 '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
        }
        ?>
 <a href="add_books.php"  class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add New</a>
        <table class="w-full my-5 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead>
                <tr>
                    <th scope="col" class="p-3 text-center text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl">ID</th>
                    <th scope="col" class="p-3 text-center text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl">Book Titke</th>
                    <th scope="col" class="p-3 text-center text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl">Author</th>
                    <th scope="col" class="p-3 text-center text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl">Genre</th>
                    <th scope="col" class="p-3 text-center text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl">Publication Date</th>
                    <th scope="col" class="p-3 text-center text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl">ISBN</th>
                    <th scope="col" class="p-3 text-center text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "db_conn.php";
                $sql = "SELECT * FROM `books`";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td class='text-center'>{$row['id']}</td>
                                <td class='text-center'>" . htmlspecialchars($row['book_title']) . "</td>
                                <td class='text-center'>" . htmlspecialchars($row['author']) . "</td>
                                <td class='text-center'>" . htmlspecialchars($row['genre']) . "</td>
                                <td class='text-center'>" . htmlspecialchars($row['p_date']) . "</td>
                                <td class='text-center' >" . htmlspecialchars($row['isbn']) . "</td>

                                <td class='text-center' >
                                    <a href='edit.php?id=" . intval($row['id']) . "' class='link-dark'>Edit</a>
                                    <a href='delete.php?id=" . intval($row['id']) . "' class='link-dark'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
  </main>
</div>
            
  



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

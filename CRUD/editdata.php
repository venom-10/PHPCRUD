<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            },

        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
          .content-auto {
            content-visibility: auto;
          }
        }
      </style>
</head>

<body>
    <?php 
        if(!isset($_COOKIE['name'])){
            setcookie('notlogin', 'OK', time()+2, '/');
            header('location:index.php');
            exit();
        }

        setcookie('id', $_GET['id'], time()+300, '/');
    ?>
    <nav>
        <div class="realtive w-full h-12 bg-slate-500">
            <span class='absolute left-5 top-2 text-white text-2xl'>CRUD</span>
            <div class="flex justify-end items-center h-full pr-4">
                <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName" class="flex items-center text-sm font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:mr-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white" type="button">
                    <span class="sr-only">Open user menu</span>
                    <?php
                    if (isset($_COOKIE['name']) && isset($_COOKIE['email'])) {
                        include('conn.php');
                        $name = $_COOKIE['name'];
                        $sql = "select * from $dbname.users where name='$name'";

                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $imagepath = $row['imagepath'];
                        echo '<img class="w-10 h-10 mr-2 rounded-full" src="./uploads/' . $imagepath . '" alt="user photo">';
                    } else {
                        echo '<img class="w-10 h-10 mr-2 rounded-full" src="./images/27470334_7309681.jpg" alt="user photo">';
                    }

                    ?>

                    <svg class="w-4 h-4 mx-1.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <div id="dropdownAvatarName" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                        <div class="font-medium ">
                            <?php
                            if (isset($_COOKIE['name'])) {
                                echo $_COOKIE['name'];
                            } else {
                                echo 'Please Log in';
                            }

                            ?>
                        </div>
                        <div class="truncate">
                            <?php
                            if (isset($_COOKIE['email'])) {
                                echo $_COOKIE['email'];
                            }


                            ?>
                        </div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                        <li>
                            <a href="index.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="uploadProfilePhoto.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">change photo</a>
                        </li>
                        <li>
                            <form class='w-full' action="logout.php" method='POST'>
                                <?php
                                if (isset($_COOKIE['name'])) {
                                    echo '<button class="block flex justify-start w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">logout</button>';
                                } else {
                                    echo '<a href="signedin.php" class="block flex justify-start w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">login</a>';
                                }

                                ?>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
    <div class="flex justify-start items-center flex-col h-full pt-10 bg-slate-300">

        <form class='w-1/2 relative' action='edit.php' method='POST'>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="state" class="block py-2.5 px-0 w-full text-black text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" autocomplete=off />
                <label for="state" class="peer-focus:font-medium absolute text-sm text-black dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">State</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="address" class="block py-2.5 px-0 w-full text-black text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" autocomplete=off />
                <label for="Address" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Address</label>
            </div>

            <select name="gender" class=' bg-blue-500 rounded-lg'>
                <option value="default" class='bg-white'>Gender</option>
                <option value="Male" class='bg-white'>Male</option>
                <option value="Female" class='bg-white'>Female</option>
                <option value="Other" class='bg-white'>Other</option>
            </select>
            <button type="submit" class="text-white absolute right-0 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

    </div>
</body>

</html>
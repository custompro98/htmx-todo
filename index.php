<!DOCTYPE HTML>

<html>
    <head>
        <title>HTMX Todo</title>
        <script
            src="https://unpkg.com/htmx.org@1.9.2"
            integrity="sha384-L6OqL9pRWyyFU3+/bjdSri+iIphTN/bvYyM37tICVyOJkWZLpP2vGn6VUEXgzg6h"
            crossorigin="anonymous">
        </script>
    </head>
    <body>
        <header>
            <h1>Todo List</h1>
        </header>
        <section>
            <table>
                <thead>
                    <tr>
                        <th>Completed</th>
                        <th>Todo</th>
                    </tr>
                </thead>
                <tbody id="todos">
                    <tr>
                        <td></td>
                        <td>
                            <form hx-post="/api/todo/create.php" hx-swap="afterend" hx-target="closest tr">
                                <input type="text" placeholder="New todo" name="todo" />
                                <input type="submit" value="Create" />
                            </form>
                        </td>
                    </tr>

                    <?php
                        $dbconn = pg_connect("host=localhost port=5432 dbname=todo user=postgres password=postgres");
                        $result = pg_query($dbconn, "SELECT id, task, completed FROM todo ORDER BY id DESC");

                        if (!$result) {
                            echo "";
                        }

                        while ($row = pg_fetch_row($result)) {
                            $is_checked = $row[2] == "t";

                            if ($is_checked) {
                                echo "<tr>";
                                    echo '<td><input type="checkbox" checked /></td>';
                                    echo "<td>$row[1]</td>";
                                echo '</tr>';
                            } else {
                                echo "<tr>";
                                    echo '<td><input type="checkbox" /></td>';
                                    echo "<td>$row[1]</td>";
                                echo '</tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </section>
        <footer>
            <span>The future is now, brought to you by PHP+HTMX ❤️</span>
        </footer>
    </body>
</html>

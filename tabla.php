<!DOCTYPE html>
<html>
<head>
    <title>Tabla PHP con Estilos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 25rem;
            height: 4.5rem;
            margin: auto;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Columna 1</th>
        </tr>
        <?php
        for ($i = 2; $i <= 4; $i++) {
            echo "<tr>";
            if ($i === 2) {
                echo "<td>eau de perfum / natural spray <br> right XXXml 3, 4FL.0Z.e</td>";
            } elseif ($i === 3) {
                echo "<td>compounded: in our lab <br> Fresh: 12 months after first sprite</td>";
            } elseif ($i === 4) {
                echo "<td>Made in Mexico-PERFUM-by Richard Castle - Calle 3 sur #305, Tecamachalco, Puebla.</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

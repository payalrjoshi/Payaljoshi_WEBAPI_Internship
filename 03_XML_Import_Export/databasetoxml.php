<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "products";

 
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn)
{
    die("Connection Failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM product";

$result = mysqli_query($conn, $sql);

if (!$result)
{
    die("Query Failed: " . mysqli_error($conn));
}

 
$xml = new DOMDocument("1.0", "UTF-8");
$xml->formatOutput = true;

 
$products = $xml->createElement("products");
$xml->appendChild($products);

 
if (mysqli_num_rows($result) > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
        $product = $xml->createElement("product");
        $products->appendChild($product);
        
        $pid = $xml->createElement("pid", $row['pid']);
        $product->appendChild($pid);

        $product->appendChild(
            $xml->createElement("pname", $row["pname"])
        );
        
        $product->appendChild(
            $xml->createElement("price", $row["price"])
        );
        
        $product->appendChild(
            $xml->createElement("qty", $row["qty"])
        );
        
        $products->appendChild($product);
    }
}

 
$xmlFile = "products.xml";

if ($xml->save($xmlFile))
{
    echo "XML File Created Successfully";
}
else
{
    echo "Error Creating XML File";
}

mysqli_close($conn);

?>

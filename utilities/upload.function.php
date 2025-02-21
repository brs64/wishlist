<?php
require_once '../database/db.php';

function fetch_metadata($url) {
    $html = file_get_contents($url);
    if ($html === FALSE) {
        throw new Exception("Failed to fetch content from URL: $url");
    }

    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $xpath = new DOMXPath($doc);

    $metadata = [
        'title' => '',
        'image' => ''
    ];

    if (strpos($url, 'fnac.com') !== false) {
        $titleElement = $xpath->query("//*[contains(@class, 'f-productHeader-reviewContainer')]");
        if ($titleElement->length > 0) {
            $metadata['title'] = $titleElement->item(0)->textContent;
        }
        $imageElement = $xpath->query("//*[contains(@class, 'f-productMedias js-product-medias')]");
        if ($imageElement->length > 0) {
            $metadata['image'] = $imageElement->item(0)->getAttribute('src');
        }
    } elseif (strpos($url, 'cultura.com') !== false) {
        // Add Cultura specific extraction logic here
    } elseif (strpos($url, 'etsy.com') !== false) {
        // Add Etsy specific extraction logic here
    } elseif (strpos($url, 'amazon.com') !== false) {
        // Add Amazon specific extraction logic here
    } elseif (strpos($url, 'pullandbear.com') !== false) {  
        // Add Pull & Bear specific extraction logic here
    }

    return $metadata;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $url = $_POST['url'];
        $price = $_POST['price'];

        $metadata = fetch_metadata($url);
        $name = $metadata['title'];
        $image = $metadata['image'];

        $stmt = $conn->prepare("INSERT INTO articles_wishlist (lien, prix, nom, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdss", $url, $price, $name, $image);

        if ($stmt->execute()) {
            echo "Article added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

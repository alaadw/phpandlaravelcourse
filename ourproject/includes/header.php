
<!DOCTYPE html>
<html lang="en">        
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo @$title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 50px;
            max-height: 50px;
        }
    </style>
    <script>
function delete_product(id) {
    if (!confirm('Delete this item?')) return;
    //confirm returns true or false
    // If user confirms, proceed with deletion
    // Use fetch API to send a POST request to delete_product.php
    // This allows us to delete without reloading the page
    fetch('delete_product.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + id 
    })
    .then(res => {
        if (res.ok) {
            document.getElementById('product-' + id).remove();
        } else {
            alert('Error deleting');
        }
    })
    .catch(() => alert('Error deleting'));
}
function delete_product_image_gallery(id) {
    if (!confirm('Delete this item?')) return;
    //confirm returns true or false
    // If user confirms, proceed with deletion
    // Use fetch API to send a POST request to delete_product.php
    // This allows us to delete without reloading the page
    fetch('delete_product_imagegallery.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + id
    })
    .then(res => {
        if (res.ok) {
            document.getElementById('gallery-image-' + id).remove();
        } else {
            alert('Error deleting');
        }
    })
    .catch(() => alert('Error deleting'));
}
 
</script>
   </head>
<body> 
    
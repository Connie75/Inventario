<?php
$stmt->bind_param("iiis", $id_producto, $id_cliente, $cantidad, $fecha);

if ($stmt->execute()) {
    // Obtener el ID de la venta insertada
    $id_venta = $stmt->insert_id;
    
    // Calcular el total de la venta
    $sql_producto = "SELECT precio FROM productos WHERE id = ?";
    $stmt_producto = $conn->prepare($sql_producto);
    $stmt_producto->bind_param("i", $id_producto);
    $stmt_producto->execute();
    $stmt_producto->bind_result($precio);
    $stmt_producto->fetch();
    
    $total = $precio * $cantidad;

    // Crear factura
    $sql_factura = "INSERT INTO facturas (id_venta, fecha, total) VALUES (?, ?, ?)";
    $stmt_factura = $conn->prepare($sql_factura);
    $stmt_factura->bind_param("isd", $id_venta, $fecha, $total);
    
    if ($stmt_factura->execute()) {
        echo "Venta y factura añadidas exitosamente.";
    } else {
        echo "Error al crear la factura: " . $conn->error;
    }
    
    $stmt_producto->close();
    $stmt_factura->close();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>

<?php
$folder = './img';

// Đường dẫn tới thư mục mới
$destinationFolder = $folder . '/png';

// Kiểm tra xem thư mục đích đã tồn tại chưa, nếu chưa thì tạo mới
if (!file_exists($destinationFolder)) {
    mkdir($destinationFolder);
}

// Lấy danh sách tên tệp trong thư mục
$fileList = scandir($folder);

// Lọc bỏ các thư mục "." và ".."
$fileList = array_diff($fileList, array('.', '..'));

// Lặp qua danh sách tệp và chuyển đổi từ .webp sang .png, sau đó di chuyển vào thư mục mới
foreach ($fileList as $file) {
    $filePath = $folder . '/' . $file;
    $ext = pathinfo($filePath, PATHINFO_EXTENSION);

    // Kiểm tra nếu là tệp .webp
    if ($ext === 'webp') {
        $pngFile = $destinationFolder . '/' . pathinfo($file, PATHINFO_FILENAME) . '.png';

        // Tạo ảnh từ tệp .webp
        $sourceImage = imagecreatefromwebp($filePath);

        // Tạo ảnh mới với định dạng .png
        imagepng($sourceImage, $pngFile);

        // Giải phóng bộ nhớ
        imagedestroy($sourceImage);

        echo 'Đã chuyển đổi ' . $file . ' thành ' . basename($pngFile) . ' và di chuyển vào thư mục png <br>';
    }
}

echo 'Hoàn thành chuyển đổi và di chuyển.';

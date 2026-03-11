<?php require_once __DIR__ . '/booking-panel.php'; ?>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/919979865551" class="whatsapp-btn" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<style>
    .whatsapp-btn {
        position: fixed;
        bottom: 30px;
        left: 30px;
        background-color: #25d366;
        color: #fff;
        width: 50px;
        height: 50px;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 2px 2px 3px #999;
        z-index: 100;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .whatsapp-btn i {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .whatsapp-btn:hover {
        background-color: #128c7e;
        color: #fff;
    }
</style>

<?php

namespace App\Enums;


enum OrderPaymentFondyStatusEnum:string {
    case created = "Замовлення було створено, але клієнт ще не ввів платіжні реквізити";
    case processing = "Замовлення все ще обробляється платіжним шлюзом";
    case declined = "Замовлення відхилено платіжним шлюзом FONDY, зовнішньою платіжною системою або банком-еквайєром";
    case approved = "Замовлення успішно завершено";
    case expired = "Термін життя замовлення минув";
    case reversed = "Раніше успішна транзакція була повністю скасована";
}

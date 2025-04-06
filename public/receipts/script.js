import { jsPDF } from "jspdf";
import QRCode from 'qrcode';

document.addEventListener('DOMContentLoaded', () => {
    // Sample data - replace with actual data retrieval
    const receiptData = {
        studentName: "John Doe",
        guardianName: "Jane Doe",
        studentNumber: "12345",
        studentClass: "10A",
        session: "2023-2024",
        term: "First Term",
        amountPaid: "$500",
        transactionReference: "TXN123456",
        receiptNumber: "RCPT0001",
        paymentDate: "2024-07-24"
    };

    // Payment details for QR code
    const paymentDetails = `Student Name: ${receiptData.studentName}\nGuardian Name: ${receiptData.guardianName}\nAmount Paid: ${receiptData.amountPaid}\nTransaction Reference: ${receiptData.transactionReference}\nReceipt Number: ${receiptData.receiptNumber}\nPayment Date: ${receiptData.paymentDate}`;

    // Generate QR code
    QRCode.toDataURL(paymentDetails, { errorCorrectionLevel: 'H' }, (err, url) => {
        if (err) {
            console.error(err);
            return;
        }
        const qrCodeImg = document.createElement('img');
        qrCodeImg.src = url;
        qrCodeImg.alt = 'QR Code';
        document.getElementById('qr-code').appendChild(qrCodeImg);
    });

    // Populate receipt with data
    document.getElementById('studentName').textContent = receiptData.studentName;
    document.getElementById('guardianName').textContent = receiptData.guardianName;
    document.getElementById('studentNumber').textContent = receiptData.studentNumber;
    document.getElementById('studentClass').textContent = receiptData.studentClass;
    document.getElementById('session').textContent = receiptData.session;
    document.getElementById('term').textContent = receiptData.term;
    document.getElementById('amountPaid').textContent = receiptData.amountPaid;
    document.getElementById('transactionReference').textContent = receiptData.transactionReference;
    document.getElementById('receiptNumber').textContent = receiptData.receiptNumber;
    document.getElementById('paymentDate').textContent = receiptData.paymentDate;


    // Print button functionality
    document.getElementById('printButton').addEventListener('click', () => {
        window.print();
    });

    // Download button functionality
    document.getElementById('downloadButton').addEventListener('click', () => {
        const receipt = document.getElementById('receipt');
        const doc = new jsPDF();

        // Add content to the PDF
        doc.html(receipt, {
            callback: function (doc) {
                doc.save('student_payment_receipt.pdf');
            },
            margin: [10, 10, 10, 10],
            autoPaging: 'text',
            x: 0,
            y: 0,
            width: doc.internal.pageSize.getWidth(),
            windowWidth: receipt.offsetWidth
        });
    });
});
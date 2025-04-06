<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        #receipt {
            width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            background-color: white;
        }

        #header {
            text-align: center;
            margin-bottom: 20px;
        }

        #logo {
            height: 80px;
            margin-bottom: 10px;
        }

        #student-info,
        #payment-info {
            margin-bottom: 20px;
        }

        #qr-code {
            text-align: center;
            margin: 20px 0;
        }

        #qr-code img {
            width: 150px;
            height: 150px;
        }

        #seal {
            text-align: center;
            font-style: italic;
            margin-top: 20px;
        }

        #watermark {
            position: absolute;
            opacity: 0.1;
            font-size: 120px;
            color: #0066cc;
            transform: rotate(-45deg);
            left: 100px;
            top: 200px;
            z-index: -1;
        }

        #buttons {
            text-align: center;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0055aa;
        }

        @media print {
            #buttons {
                display: none;
            }

            body {
                padding: 0;
            }
        }

        .amount-in-words {
            font-style: italic;
            color: #555;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script>
</head>

<body>
    <div id="receipt">
        <div id="header">
            <img src="{{ asset('/frontend/images/logo.png') }}" alt="School Logo" id="logo">
            <h2>Tes'B Academy</h2>
            <h3>Student Payment Receipt</h3>
        </div>
        <div id="student-info">
            <p><strong>Student Name:</strong> <span id="studentName">{{ $receipt->name }}</span></p>
            <p><strong>Guardian Name:</strong> <span id="guardianName">{{ $authUser->name }}</span></p>
            <p><strong>Student Number:</strong> <span id="studentNumber">{{ $receipt->student_number }}</span></p>
            <p><strong>Student Class:</strong> <span id="studentClass">{{ $receipt->student_class }}</span></p>
            <p><strong>Session:</strong> <span id="session">{{ $receipt->session }}</span></p>
            <p><strong>Term:</strong> <span id="term">{{ $receipt->term }}</span></p>
        </div>
        <div id="payment-info">
            <p><strong>Amount Paid:</strong>
                <span id="amountPaid">{{ $receipt->amount }}</span>
                <span id="amountInWords" class="amount-in-words"></span>
            </p>
            <p><strong>Transaction Reference:</strong> <span id="transactionReference">{{ $receipt->tx_ref }}</span></p>
            <p><strong>Receipt Number:</strong>RCPT_ <span id="receiptNumber">{{ $receipt->txr_id }}</span></p>
            <p><strong>Date of Payment:</strong> <span id="paymentDate">{{ $receipt->created_at }}</span></p>
        </div>
        <div id="qr-code">
        </div>
        <div id="seal">
            <p>Thank you for your payment!</p>
        </div>
        <div id="watermark">PAID</div>
        <div id="footer">
        </div>
    </div>
    <div id="buttons">
        <button id="printButton">Print Receipt</button>
        <button id="downloadPdfButton">Download as PDF</button>
        <button id="downloadImageButton">Download as Image</button>
        <a href="{{ url()->previous() }}">
            <button id="back">Back</button>
        </a>
    </div>

    <script>
        // Function to convert numbers to words
        function numberToWords(num) {
            const units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
            const teens = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen',
                'Nineteen'
            ];
            const tens = ['', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

            function convertLessThanOneThousand(n) {
                if (n === 0) return '';
                if (n < 10) return units[n];
                if (n < 20) return teens[n - 10];
                if (n < 100) return tens[Math.floor(n / 10)] + ' ' + units[n % 10];
                return units[Math.floor(n / 100)] + ' Hundred ' + convertLessThanOneThousand(n % 100);
            }

            if (num === 0) return 'Zero';
            let result = '';
            const billion = Math.floor(num / 1000000000);
            num %= 1000000000;
            const million = Math.floor(num / 1000000);
            num %= 1000000;
            const thousand = Math.floor(num / 1000);
            num %= 1000;
            const remainder = num;

            if (billion) result += convertLessThanOneThousand(billion) + ' Billion ';
            if (million) result += convertLessThanOneThousand(million) + ' Million ';
            if (thousand) result += convertLessThanOneThousand(thousand) + ' Thousand ';
            if (remainder) result += convertLessThanOneThousand(remainder);

            return result.trim() + ' Naira Only';
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Format the payment date
            const paymentDateElement = document.getElementById('paymentDate');
            if (paymentDateElement.textContent) {
                const date = new Date(paymentDateElement.textContent);
                paymentDateElement.textContent = date.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            // Generate receipt number if empty
            const receiptNumberElement = document.getElementById('receiptNumber');
            if (!receiptNumberElement.textContent.trim()) {
                receiptNumberElement.textContent = 'RCPT-' + Math.floor(100000 + Math.random() * 900000);
            }

            // Convert amount to words
            const amountPaidElement = document.getElementById('amountPaid');
            const amountInWordsElement = document.getElementById('amountInWords');

            // Extract numeric value from amount (remove any currency symbols)
            const numericAmount = parseFloat(amountPaidElement.textContent.replace(/[^0-9.]/g, ''));

            if (!isNaN(numericAmount)) {
                const amountInWords = numberToWords(Math.floor(numericAmount));
                amountInWordsElement.textContent = `(${amountInWords})`;

                // Update the amount paid to include currency symbol if not present
                if (!amountPaidElement.textContent.match(/^[₦$£€]/)) {
                    amountPaidElement.textContent = '₦' + amountPaidElement.textContent;
                }
            }

            // Payment details for QR code
            const paymentDetails = `Student Name: ${document.getElementById('studentName').textContent}
Guardian Name: ${document.getElementById('guardianName').textContent}
Amount Paid: ${amountPaidElement.textContent} ${amountInWordsElement.textContent}
Transaction Ref: ${document.getElementById('transactionReference').textContent}
Receipt Number: ${receiptNumberElement.textContent}
Payment Date: ${paymentDateElement.textContent}`;

            // Generate QR code
            QRCode.toDataURL(paymentDetails, {
                errorCorrectionLevel: 'H'
            }, (err, url) => {
                if (err) {
                    console.error(err);
                    return;
                }
                const qrCodeImg = document.createElement('img');
                qrCodeImg.src = url;
                qrCodeImg.alt = 'QR Code';
                document.getElementById('qr-code').appendChild(qrCodeImg);
            });

            // Print button functionality
            document.getElementById('printButton').addEventListener('click', () => {
                window.print();
            });

            // Download as PDF button functionality
            document.getElementById('downloadPdfButton').addEventListener('click', async () => {
                const {
                    jsPDF
                } = window.jspdf;
                const receipt = document.getElementById('receipt');
                const doc = new jsPDF('p', 'pt', 'a4');

                await doc.html(receipt, {
                    callback: function(doc) {
                        doc.save('payment_receipt.pdf');
                    },
                    margin: [20, 20, 20, 20],
                    autoPaging: 'text',
                    width: 600,
                    windowWidth: receipt.offsetWidth
                });
            });

            // Download as Image button functionality
            document.getElementById('downloadImageButton').addEventListener('click', () => {
                const receipt = document.getElementById('receipt');

                html2canvas(receipt, {
                    scale: 2, // Higher quality
                    logging: false,
                    useCORS: true,
                    allowTaint: true,
                    backgroundColor: '#FFFFFF'
                }).then(canvas => {
                    const link = document.createElement('a');
                    link.download = 'payment_receipt.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                });
            });
        });
    </script>
</body>

</html>

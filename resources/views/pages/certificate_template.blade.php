<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/cert.css') }}">
    <title>Document</title>
</head>
<body>
    <div style="display: grid; grid-template-columns:2fr 2fr; padding:20px">
        @foreach ($particips as $particip)
            <div>
                <div class="container">
                    <img class="frame" src="{{ asset('images/cert.frame.jpg') }}" alt="certification" border="0">  
                    <div class="centered">
                        <span style="font-weight:bold">Certificate of Completion</span></br></br>
                        <span><i>This is to certify that</i></span>
                        </br></br>
                        <span style="font-weight:bold">{{ ucfirst($particip['participant_name']) }}</span></br></br>
                        <span><i>has completed the course</i></span></br></br>
                        <span style="font-weight:bold; width:500px; display:inline-block">{{ $particip->host->title }}</span>
                        <div class="cert_ref_id">
                            <h6>Certificate Id</h6>
                            <p >{{ $particip->certificate_reference_id }}</p>
                        </div>
                    </div>
                </div>
                <button class="download-pdf-btn">Download Certificate</button>
            </div>
        @endforeach
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.download-pdf-btn').forEach(button => {
            button.addEventListener('click', function() {
                const elementToDownload = this.previousElementSibling; // Get the div before the button
                // console.log(parentDiv)

                const opt = {
                    margin:       0.5,
                    filename:     'certificate.pdf',
                    image:        { type: 'jpeg', quality: 0.98 },
                    html2canvas:  { scale: 2 },
                    jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
                };

                // Convert image to data URL
                const imgElement = elementToDownload.querySelector('.frame');
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = imgElement.width;
                canvas.height = imgElement.height;
                ctx.drawImage(imgElement, 0, 0);
                const imgDataUrl = canvas.toDataURL('image/jpeg');

                // Replace image source with data URL
                imgElement.src = imgDataUrl;

                html2pdf().from(elementToDownload).set(opt).save();
            });
        });
    </script>
</body>
</html>

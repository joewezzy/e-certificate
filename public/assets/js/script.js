let FILE_NAME = `{{config('app.forum_name')}} Certificate - {{$details->name}}`;
var CERT_WIDTH = 842;
var CERT_HEIGHT = 595.4;

var widthInPT = (CERT_WIDTH / 96) * 72;
var heightInPT = (CERT_HEIGHT / 96) * 72;

var certPDF = new jsPDF("l", "pt", [widthInPT, heightInPT]);
var certHTML = document.getElementById("cert-outlet");

document.getElementById("toPng").addEventListener("click", generatePNG);
document.getElementById("toPdf").addEventListener("click", generatePDF);

function generatePNG() {
    const node = document.getElementById("cert-outlet");
    var scale = 1;
    domtoimage
        .toPng(node, {
            width: node.clientWidth * scale,
            height: node.clientHeight * scale,
            style: {
                transform: "scale(" + scale + ")",
                transformOrigin: "top left",
            },
        })
        .then(function (dataUrl) {
            const link = document.createElement("a");
            link.download = FILE_NAME + ".png";
            link.href = dataUrl;
            link.click();
        });
}

function generatePDF() {
    const node = document.getElementById("cert-outlet");
    var scale = 1;
    domtoimage
        .toPng(node, {
            width: node.clientWidth * scale,
            height: node.clientHeight * scale,
            style: {
                transform: "scale(" + scale + ")",
                transformOrigin: "top left",
            },
        })
        .then(function (dataUrl) {
            certPDF.addImage(dataUrl, "png", 0, 0, widthInPT, heightInPT);
            certPDF.save(FILE_NAME);
        });
}

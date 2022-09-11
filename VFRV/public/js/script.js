
const names='Joel';
var wait=0;
const video = document.getElementById('videoInput')
console.log(names);

Promise.all([
    faceapi.nets.faceRecognitionNet.loadFromUri('/Sample/VFRV/public/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('/Sample/VFRV/public/models'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('/Sample/VFRV/public/models') //heavier/accurate version of tiny face detector
]).then(start)

function start() {
    document.body.append('Models Loaded ')
    
    navigator.getUserMedia(
        { video:{} },
        stream => video.srcObject = stream,
        err => console.error(err)
    )
    
    console.log('video added')
    recognizeFaces()
}

async function recognizeFaces() {

    const labeledDescriptors = await loadLabeledImages()
    console.log(labeledDescriptors)
    const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.7)


    video.addEventListener('play', async () => {
        console.log('Playing')
        const canvas = faceapi.createCanvasFromMedia(video)
        document.body.append(canvas)

        const displaySize = { width: video.width, height: video.height }
        faceapi.matchDimensions(canvas, displaySize)

        setInterval(async () => {
            const detections = await faceapi.detectAllFaces(video).withFaceLandmarks().withFaceDescriptors()

            const resizedDetections = faceapi.resizeResults(detections, displaySize)

            canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)

            const results = resizedDetections.map((d) => {
                return faceMatcher.findBestMatch(d.descriptor)
            })
           
            results.forEach( (result, i) => {
                const box = resizedDetections[i].detection.box
                const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
                const value=result.toString()
                let position = value.search(names);
                console.log(position)
                if (position==0)
                wait=wait+1;

                if (wait==100)
                window.location.href="/Sample/OAMS/VideoIdentificationSuccess.html"
                drawBox.draw(canvas)
            })
        }, 100)


        
    })
}


function loadLabeledImages() {
    const labels = ['Joel'] // for WebCam
    return Promise.all(
        labels.map(async (label)=>{
            const descriptions = []
            for(let i=1; i<=12; i++) {
                const img = await faceapi.fetchImage(`/Sample/VFRV/public/labeled_images/${label}/${i}.jpg`)
                const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
                console.log(label + i + JSON.stringify(detections))
                descriptions.push(detections.descriptor)
            }
            document.body.append(label+' Faces Loaded | ')
            console.log(names);
            return new faceapi.LabeledFaceDescriptors(label, descriptions)
        })
    )
}

//New One
/*
const imageUpload = document.getElementById('imageUpload')
console.log("Hello!")

Promise.all([
  faceapi.nets.faceRecognitionNet.loadFromUri('/Sample/FRV/models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('/Sample/FRV/models'),
  faceapi.nets.ssdMobilenetv1.loadFromUri('/Sample/FRV/models')
]).then(start)

async function start() {
  const container = document.createElement('div')
  container.style.position = 'relative'
  document.body.append(container)
  const labeledFaceDescriptors = await loadLabeledImages()
  const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6)
  let image
  let canvas
  document.body.append('Loaded')
  imageUpload.addEventListener('change', async () => {
    if (image) image.remove()
    if (canvas) canvas.remove()
    image = await faceapi.bufferToImage(imageUpload.files[0])
    container.append(image)
    canvas = faceapi.createCanvasFromMedia(image)
    container.append(canvas)
    const displaySize = { width: image.width, height: image.height }
    faceapi.matchDimensions(canvas, displaySize)
    const detections = await faceapi.detectAllFaces(image).withFaceLandmarks().withFaceDescriptors()
    const resizedDetections = faceapi.resizeResults(detections, displaySize)
    const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
    results.forEach((result, i) => {
      const box = resizedDetections[i].detection.box
      const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
      drawBox.draw(canvas)
    })
  })
}

function loadLabeledImages() {
  const labels = ['Black Widow', 'Captain America', 'Captain Marveli', 'Hawkeye', 'Jim Rhodes', 'Joel', 'Thor', 'Tony Stark']
  const labelu=['Joel'];
  return Promise.all(
    labelu.map(async label => {
      const descriptions = []
      for (let i = 1; i <= 12; i++) {
        const img = await faceapi.fetchImage(`C:/xampp/htdocs/Sample/FRV/labeled_images/${label}/${i}.jpg`)
        //const img = await faceapi.fetchImage(`https://raw.githubusercontent.com/WebDevSimplified/Face-Recognition-JavaScript/master/labeled_images/${label}/${i}.jpg`)
        console.log("1")
        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
        descriptions.push(detections.descriptor)
      }

      return new faceapi.LabeledFaceDescriptors(label, descriptions)
    })
  )
}
*/
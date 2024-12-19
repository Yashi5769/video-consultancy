const localVideo = document.getElementById("localVideo");
const remoteVideo = document.getElementById("remoteVideo");
const startCallButton = document.getElementById("startCall");
const endCallButton = document.getElementById("endCall");

let localStream;
let peerConnection;
const configuration = { iceServers: [{ urls: "stun:stun.l.google.com:19302" }] };

navigator.mediaDevices
  .getUserMedia({ video: true, audio: true })
  .then((stream) => {
    localStream = stream;
    localVideo.srcObject = stream;
    startCallButton.disabled = false;
  })
  .catch((error) => {
    console.error("Error accessing media devices:", error);
    alert("Please allow access to your camera and microphone.");
  });

let localOffer;
let remoteOffer;

startCallButton.addEventListener("click", async () => {
  startCallButton.disabled = true;
  endCallButton.disabled = false;

  peerConnection = new RTCPeerConnection(configuration);

  localStream.getTracks().forEach((track) => peerConnection.addTrack(track, localStream));

  peerConnection.ontrack = (event) => {
    remoteVideo.srcObject = event.streams[0];
  };

  localOffer = await peerConnection.createOffer();
  await peerConnection.setLocalDescription(localOffer);

  console.log("Local Offer: ", localOffer);
  setTimeout(async () => {
    remoteOffer = localOffer;
    await peerConnection.setRemoteDescription(remoteOffer);

    const remoteAnswer = await peerConnection.createAnswer();
    await peerConnection.setLocalDescription(remoteAnswer);
    await peerConnection.setRemoteDescription(remoteAnswer);
  }, 1000);
});
endCallButton.addEventListener("click", () => {
  if (peerConnection) {
    peerConnection.close();
    peerConnection = null;
  }
  startCallButton.disabled = false;
  endCallButton.disabled = true;
  remoteVideo.srcObject = null;
});
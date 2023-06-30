const msgerForm = get(".msger-inputarea");
const msgerInput = get(".msger-input");
const msgerChat = get(".msger-chat");

const PERSON_IMAGE = '/img/avatar/hombre.png';

const chatWith = get('.chatWith');
const typing = get('.typing');
const chatStatus = get('.chatStatus');

function send_message() {
    const msgText = msgerInput.value;

    if (!msgText) return;

    console.log(msgText)
    // Aquí vamos a colocar código más adelante

    axios.post('/message/send', {
        message: msgText,
        chat: 2,
    }).then(response => {

        let data = response.data

        appendMessage(
            data.user.name,
            PERSON_IMAGE,
            'right',
            data.content,
            formatDate(new Date(data.created_at))
        )

        console.log(response)

    }).catch(error => {

        console.log('error')
        console.error(error)

    })

    msgerInput.value = "";
}

document.querySelector('#form-send').addEventListener("submit", event => {

    event.preventDefault();

    send_message()
});

function appendMessage(name, img, side, text, date) {
    //   Simple solution for small apps
    const msgHTML = `
    <div class="msg ${side}-msg">
      <div class="msg-img" style="background-image: url(${img})"></div>

      <div class="msg-bubble">
        <div class="msg-info">
          <div class="msg-info-name">${name}</div>
          <div class="msg-info-time">${date}</div>
        </div>

        <div class="msg-text">${text}</div>
      </div>
    </div>
  `;

    msgerChat.insertAdjacentHTML("beforeend", msgHTML);
    msgerChat.scrollTop += 500;
}

// Utils
function get(selector, root = document) {
    return root.querySelector(selector);
}

function formatDate(date) {
    const d = date.getDate();
    const mo = date.getMonth() + 1;
    const y = date.getFullYear();
    const h = "0" + date.getHours();
    const m = "0" + date.getMinutes();
    return `${d}/${mo}/${y} ${h.slice(-2)}:${m.slice(-2)}`;
}

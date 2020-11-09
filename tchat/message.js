
function getMessages(){
  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open("GET", "message.php");

  requeteAjax.onload = function(){
    const resultat = JSON.parse(requeteAjax.responseText);
    const html = resultat.reverse().map(function(messages){
      return `
        <div class="message">
          <span class="date">${messages.created_at.substring(11, 16)}</span>
          <span class="username">${messages.username}</span> : 
          <br>
          <span class="message_text">${messages.message}</span>
          <hr>
        </div>
      `
    }).join('');

    const messages = document.querySelector('.messages');

    messages.innerHTML = html;
    messages.scrollTop = messages.scrollHeight;
  }

  requeteAjax.send();
}


function postMessage(){
  
  const message = document.querySelector('#message');

  const data = new FormData();
  data.append('message', message.value);

  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open('POST', 'message.php?param=write');
  
  requeteAjax.onload = function(){
    message.value = '';
    message.focus();
    getMessages();
  }

  requeteAjax.send(data);
}

const interval = window.setInterval(getMessages, 10000);

getMessages();
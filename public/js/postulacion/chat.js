var chatConfig, $divZeroComments, $ulChatList, $btnSentMsg, currentMonth;

function initChat(configurations){
    chatConfig = configurations;

    $divZeroComments = $('#zero-comments');
    $btnSentMsg = $("#sent-message");
    $ulChatList = $("#chat-list")

    moment.locale('es');
    retrieveChat();
}

$( document ).ready(function() {
    $btnSentMsg.click(addChatItem);

    $("#txt-new-comment").on('keyup', (keyEvt) => {
        if( keyEvt.code === 'Enter' ) addChatItem()
    })
});

function addChatItem() {
    $txtMessage = $("#txt-new-comment");
    storeChatMessage($txtMessage.val());
    $txtMessage.val('');
    if( $divZeroComments!=null ){
        $divZeroComments.css('display', 'none');
        $divZeroComments = null;
    }
}

function retrieveChat() {
    $.ajax({
        url: chatConfig.retrieveUrl,
        type: 'GET',
        dataType: 'json',

        success: function (response) {
            console.log(Object.keys(response));
            if( response.success ){
                renderChatItems(response.data);
            }
        },
        error: handleError
    })
}

function storeChatMessage(message) {
    let postData = {
        '_token': chatConfig.csrfToken,
        'comment': message,
        'postulacion_id': chatConfig.postulationId,
    };
    $.ajax({
        url: chatConfig.storeUrl,
        type: 'POST',
        data: postData,
        dataType: 'json',

        success: function (response) {
            console.log(Object.keys(response));
            renderNewChatItem(message);
        },
        error: handleError
    });
}

function renderChatItems(comments) {
    $ulChatList.html('');
    let chatMap = new Map();
    for(comment of comments){
        momentObj = moment(comment.created_at);
        comment.date = momentObj;

        yearAndMonthKey = createKey(momentObj);
        if( !chatMap.has(yearAndMonthKey) ){
            chatMap.set(yearAndMonthKey, []);
        }
        chatMap.get(yearAndMonthKey).push(comment);
    }

    for(let [key, value] of sortMap(chatMap)){
        let msgsByMonth = value;
        let htmlMessages = msgsByMonth
            .sort((msg1, msg2) => msg2.date.isBefore(msg1.date) ? -1 : 1 )
            .map(msg => getChatItemHtml(msg))
            .join('');

        currentMonth = moment(key.toString(), "YYYYMM");

        $ulChatList.prepend(htmlMessages);
        $ulChatList.prepend(getSeparatorHtml(currentMonth.format('MMMM YYYY')));
    }
}

function createKey(moment){
    return moment.year()*100+moment.month()
}

function sortMap(sourceMap) {
    return new Map( [...sourceMap.entries()].sort())
}

function renderNewChatItem(message) {
    let msgObj = {
        comment: message,
        isSelf : true,
        date   : moment()
    }
    $ulChatList.prepend(getChatItemHtml(msgObj));
}

function getChatItemHtml(message) {
    let oddClass = message.isSelf ? 'odd' : '';
    let textAlignClass = message.isSelf ? 'text-right' : '';
    return `
    <li class="chat-item list-style-none mt-3 ${oddClass}">
        <div class="chat-content d-inline-block pl-3 ${textAlignClass}">
            ${getMessageContentHtml(message)}
            <br>
        </div>
    </li>
    `;
}

function getMessageContentHtml(message) {
    let time = getMessageTime(message.date);
    let chatTimeClass = message.isSelf ? 'chat-time' : '';

    let msgText = `<div class="msg p-2 d-inline-block mb-1">${message.comment}</div>`;
    let msgTime = `<span class="${chatTimeClass} font-12 mt-1 mr-0 mb-3"> ${time} </span>`;
    return message.isSelf ? msgTime+msgText : msgText+msgTime;
}

function getSeparatorHtml(date) {
    return `
    <li class="chat-item list-style-none mt-3">
        <div class="chat-content text-center d-inline-block pl-3">
            <span class="chat-time font-14 mt-1 mr-0 mb-3">${date}</span>
            <br>
        </div>
    </li>
    `;
}

function getMessageTime(messageDate) {
    let isAfter3HoursAgo = messageDate.isAfter(moment().subtract(3, 'hours'));
    return isAfter3HoursAgo ? messageDate.fromNow() : messageDate.format('ddd D  h:mm a');
}

function handleError(e1, e2, e3) {
    console.log(e1);
    console.log(e2);
    console.log(e3);
    $('#commentErrorMdl').modal();
}

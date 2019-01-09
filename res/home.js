const TWEETPAGE = 0;
const USERPAGE = 1;
const PROFILEPAGE = 2;
const ADMINPAGE = 3;

const tweets = [{
        screenName: "CremonaStefano",
        content: "Non ce la faccio piuuuuuuuuu!! Quando finisce?"
    },{
        screenName: "La Patata",
        content: "Sono fritta?"
    },{
        screenName: "Massimo",
        content: "Mi sono perso i nipotini"
    },
];

const users = [{
    screenName: "CremonaStefano",
    gender: 1,
    tweets: 18
}, {
    screenName: "La Patata",
    gender: 0,
    tweets: 2918
}, {
    screenName: "Massimo",
    gender: null,
    tweets: 5
}];

const keyWords = {
    positive: [],
    negative: []
}

function loadKeyWords(onSuccess) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            switch (this.status) {
                case 200:
                    try {
                        var response = JSON.parse(this.responseText);
                        console.log(response);
                        //reload the page
                        keyWords.positive = [];
                        keyWords.negative = [];
                        response.payload.forEach(element => {
                            if(element.positive == true) keyWords.positive.push(element.keyword); else keyWords.negative.push(element.keyword);
                        });
                        if (onSuccess) {
                            onSuccess();
                        }
                    } catch (error) {
                        console.log(error);
                    }
                    break;
                case 403:
                case 404:
                case 500:
                default:
                    console.log('An unexpected error occurred: ' + this.status);
            }
            //hideSpinner();
        }
    }
    xmlhttp.open("GET", "./json/keywords.php", true);
    //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}

loadKeyWords();

function deleteKeyWord(keyword) {
    var answer = confirm("Do you really want to delete the keyword '" + keyword +"'");
    if (!answer) {
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            switch (this.status) {
                case 200:
                    try {
                        var response = JSON.parse(this.responseText);
                        console.log(response);
                        //reload the page
                        loadKeyWords(() => populateMainPage(ADMINPAGE));
                        alert(response.message);
                    } catch (error) {
                        alert(error);
                    }
                    break;
                case 403:
                case 404:
                case 500:
                default:
                    alert('An unexpected error occurred: ' + this.status);
            }
            //hideSpinner();
        }
    }
    xmlhttp.open("POST", "./json/deleteKeyword.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("keyword="+keyword);
}

function saveKeyWord(keyword, positive) {
    if (keyword.length === 0 || positive.length === 0) {
        alert('Insert a word, please!');
        return;
    }
    var answer = confirm("Do you really save the keyword '" + keyword +"'");
    if (!answer) {
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            switch (this.status) {
                case 200:
                    try {
                        var response = JSON.parse(this.responseText);
                        console.log(response);
                        //reload the page
                        loadKeyWords(() => populateMainPage(ADMINPAGE));
                        alert(response.message);
                    } catch (error) {
                        alert(error);
                    }
                    break;
                case 403:
                case 404:
                case 500:
                default:
                    alert('An unexpected error occurred: ' + this.status);
            }
            //hideSpinner();
        }
    }
    xmlhttp.open("POST", "./json/saveKeyword.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("keyword="+keyword+'&positive='+parseInt(positive, 10));
}

function populateMainPage(page) {
    let innerHTML = '<div id="usersMainPage" class="mainPage"><div class="mainPageTitle">No page found</div></div>';
    switch (page) {
        case USERPAGE: {
            innerHTML = '<div id="usersMainPage" class="mainPage"><div class="mainPageTitle">The Users</div>';
            users.forEach(element => {
                let userIcon = 'no-gender';
                switch (element.gender) {
                    case 0:
                        userIcon = 'female';
                        break;
                    case 1:
                        userIcon = 'male';
                        break;
                    default:
                        break;
                }
                innerHTML += '<div id="avatarContainer" class="horizontal centeredV padded">' +
                                '<img class="icon" src=\'./res/'+userIcon+'-user.png\' />' +
                                '<div class="tweetAuthor" >'+element.screenName+'</div>' +
                                '<div class="tweetContent" >&nbsp;-&nbsp;'+element.tweets+'&nbsp;tweets</div>' +
                            '</div>';
            });
            innerHTML += '</div>';
            break;
        } case PROFILEPAGE: {
            innerHTML = '<div id="usersMainPage" class="mainPage">';
            innerHTML += '<div class="mainPageTitle horizontal centeredV"><div class="hundredPercent">Edit Your profile</div><div class="saveButton">Save</div></div>';
            innerHTML += '<div id="avatarContainer" class="horizontal centeredV padded">';
                innerHTML += '<img class="iconRounded" src=\'./res/male-user.png\' />';
                innerHTML += '<input type="text" class="descIcon leftPadded eightyPerCent" id="nameInput" value="Stefano Cremona">';
                innerHTML += '</div>';
                innerHTML += '<div id="townContainer" class="horizontal centeredV padded">';
                innerHTML += '<img class="iconRounded greenLight" src=\'./res/town.png\' />';
                innerHTML += '<input type="text" class="descIcon leftPadded eightyPerCent" value="Rome - Italy"/>';
                innerHTML += '</div>';
                innerHTML += '<div id="jobContainer" class="horizontal centeredV padded">';
                innerHTML += '<img class="iconRounded greenLight" src=\'./res/job.png\' />';
                innerHTML += '<input type="text" class="descIcon leftPadded eightyPerCent" value="Software Developer"/>';
                innerHTML += '</div>';
                innerHTML += '<div id=aboutMeContainer" class="horizontal centeredV padded">';
                innerHTML += '<img class="iconRounded greenLight" src=\'./res/aboutMe.png\' />';
                innerHTML += '<input type="text" class="descIcon leftPadded eightyPerCent" value="I like travelling, fishing, playing tennis, IT, clubbing, going out with friends."/>';
                innerHTML += '</div>';
                innerHTML += '<div id="ageContainer" class="horizontal centeredV padded">';
                innerHTML += '<img class="iconRounded greenLight" src=\'./res/age.png\' />';
                innerHTML += '<input type="text" class="descIcon leftPadded eightyPerCent" value="18-25"/>';
                innerHTML += '</div>';
                innerHTML += '<div id="kidsContainer" class="horizontal centeredV padded">';
                innerHTML += '<img class="iconRounded greenLight" src=\'./res/kids.png\' />';
                innerHTML += '<input type="text" class="descIcon leftPadded eightyPerCent" value="0"/>';
                innerHTML += '</div>';
            innerHTML += '</div>';
            break;
        } case ADMINPAGE: {
            innerHTML =  '<div id="usersMainPage" class="mainPage">';
                innerHTML += '<div class="mainPageTitle horizontal centeredV"><div class="hundredPercent">Edit the keywords</div></div>';
                innerHTML += '<div class="horizontal" style="margin-bottom: 14px">';
                    innerHTML += '<div class="fiftyPercent" style="padding-right: 14px">';
                        innerHTML += '<input id="positiveWord" class="hundredPercent fontMiddle padded" type="text" placeholder="A positive word..."/>';
                        innerHTML += '<a href="#" onclick="saveKeyWord(document.getElementById(\'positiveWord\').value, 1)" class="saveButton centeredV positiveElement">Save</a>';
                    innerHTML += '</div>';
                    innerHTML += '<div class="fiftyPercent" >';
                        innerHTML += '<input id="negativeWord" class="hundredPercent fontMiddle padded" type="text" placeholder="A negative word..."/>';
                        innerHTML += '<a href="#" onclick="saveKeyWord(document.getElementById(\'negativeWord\').value, 0)" class="saveButton negativeElement centeredV">Save</a>';
                    innerHTML += '</div>';
                innerHTML += '</div>';
                innerHTML += '<div class="padded">Tap to delete</div>';
                innerHTML += '<div class="horizontal">';
                    innerHTML += '<div class="fiftyPercent wrap" >';
                    keyWords.positive.forEach(element => {
                        innerHTML += '<a onclick="deleteKeyWord(\''+element+'\')" href="#" class="keyWordElement positiveElement">'+element+'</a>';
                    });
                    innerHTML += '</div>';
                
                    innerHTML += '<div class="fiftyPercent">';
                    keyWords.negative.forEach(element => {
                        innerHTML += '<a onclick="deleteKeyWord(\''+element+'\')" href="#" class="keyWordElement negativeElement">'+element+'</a>';
                    });
                    innerHTML += '</div>';
                innerHTML += '</div>';
            innerHTML += '</div>';
            break;
        } case TWEETPAGE:
        default: {
            innerHTML = '<div id="tweetsMainPage" class="mainPage">';
            innerHTML += '<div class="mainPageTitle">The Tweets</div>';
            tweets.forEach(element => {
                innerHTML += '<div id="avatarContainer" class="horizontal centeredV padded">' +
                                '<img class="icon" src=\'./res/tweetIcon.png\' />' +
                                '<div>' +
                                '<div class="tweetAuthor" >'+element.screenName+'</div>' +
                                '<div class="tweetContent" >'+element.content+'</div>' +
                                '</div>' +
                            '</div>';
            });
            innerHTML += "</div>";
            break;
        }
    }
    document.getElementById("mainPage").innerHTML = innerHTML;
};

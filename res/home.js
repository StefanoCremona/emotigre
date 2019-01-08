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
            innerHTML = '<div id="usersMainPage" class="mainPage"><div class="mainPageTitle">Edit Your profile</div>';
            innerHTML += '<div id="avatarContainer" class="horizontal centeredV padded">';
                innerHTML += '<img class="iconRounded" src=\'./res/male-user.png\' />';
                innerHTML += '<div class="descIcon" id="name">Stefano Cremona</div>';
                innerHTML += '</div>';
                innerHTML += '<div id="townContainer" class="horizontal centeredV padded">';
                innerHTML += '<img class="iconRounded greenLight" src=\'./res/town.png\' />';
                innerHTML += '<div class="descIcon" id="town">Roma - Italy</div>';
                innerHTML += '</div>';
                innerHTML += '<div id="jobContainer" class="horizontal centeredV padded">';
                innerHTML += '<img class="iconRounded greenLight" src=\'./res/job.png\' />';
                innerHTML += '<div class="descIcon" id="job">Software Developer</div>';
                innerHTML += '</div>';
                innerHTML += '<div id=aboutMeContainer" class="horizontal centeredV padded">';
                innerHTML += '<img class="iconRounded greenLight" src=\'./res/aboutMe.png\' />';
                innerHTML += '<div class="descIcon" id="about">I like travelling, fishing, playing tennis, IT, clubbing, going out with friends.</div>';
                innerHTML += '</div>';
                innerHTML += '<div id="ageContainer" class="horizontal centeredV padded">';
                innerHTML += '<img class="iconRounded greenLight" src=\'./res/age.png\' />';
                innerHTML += '<div class="descIcon" id="age">18-25</div>';
                innerHTML += '</div>';
                innerHTML += '<div id="kidsContainer" class="horizontal centeredV padded">';
                innerHTML += '<img class="iconRounded greenLight" src=\'./res/kids.png\' />';
                innerHTML += '<div class="descIcon" id="kids">0</div>';
                innerHTML += '</div>';
            innerHTML += '</div>';
            break;
        } case ADMINPAGE: {
            innerHTML = '<div id="usersMainPage" class="mainPage"><div class="mainPageTitle">Set the keywords</div></div>';
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

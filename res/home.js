const TWEETPAGE = 0;
const USERPAGE = 1;
const PROFILEPAGE = 2;
const ADMINPAGE = 3;

function populateMainPage(page) {
    let innerHTML = '<div id="usersMainPage" class="mainPage"><div class="mainPageTitle">No page found</div></div>';
    switch (page) {
        case USERPAGE:
            innerHTML = '<div id="usersMainPage" class="mainPage"><div class="mainPageTitle">User Page</div></div>';
            break;
        case PROFILEPAGE:
            innerHTML = '<div id="usersMainPage" class="mainPage"><div class="mainPageTitle">Profile Page</div></div>';
            break;
        case ADMINPAGE:
            innerHTML = '<div id="usersMainPage" class="mainPage"><div class="mainPageTitle">Admin Page</div></div>';
            break;
        case TWEETPAGE:
        default:
            innerHTML = '<div id="tweetsMainPage" class="mainPage">' +
            '<div class="mainPageTitle">The Tweets</div>' +
            '<div id="avatarContainer" class="horizontal centeredV padded">' +
              '<img class="icon" src=\'./res/tweetIcon.png\' />' +
              '<div>' +
                '<div class="tweetAuthor" >Stefano Cremona</div>' +
                '<div class="tweetContent" >Non ce la faccio piuuuuuuuuu!! Quando finisce?</div>' +
              '</div>' +
            '</div>' +
            '<div id="avatarContainer" class="horizontal centeredV padded">' +
              '<img class="icon" src=\'./res/tweetIcon.png\' />' +
              '<div>' +
                '<div class="tweetAuthor" >Stefano Cremona</div>' +
                '<div class="tweetContent" >Non ce la faccio piuuuuuuuuu!! Quando finisce?</div>' +
                '</div>' +
            '</div>' +
            '<div id="avatarContainer" class="horizontal centeredV padded">' +
              '<img class="icon" src=\'./res/tweetIcon.png\' />' +
              '<div>' +
                '<div class="tweetAuthor" >Stefano Cremona</div>' +
                '<div class="tweetContent" >Non ce la faccio piuuuuuuuuu!! Quando finisce?</div>' +
              '</div>' +
            '</div>' +
            '<div id="avatarContainer" class="horizontal centeredV padded">' +
              '<img class="icon" src=\'./res/tweetIcon.png\' />' +
              '<div>' +
                '<div class="tweetAuthor" >Stefano Cremona</div>' +
                '<div class="tweetContent" >Non ce la faccio piuuuuuuuuu!! Quando finisce?</div>' +
              '</div>' +
            '</div>' +
            '<div id="avatarContainer" class="horizontal centeredV padded">' +
              '<img class="icon" src=\'./res/tweetIcon.png\' />' +
              '<div>' +
                '<div class="tweetAuthor" >Stefano Cremona</div>' +
                '<div class="tweetContent" >Non ce la faccio piuuuuuuuuu!! Quando finisce?</div>' +
              '</div>' +
            '</div>' +
            '<div id="avatarContainer" class="horizontal centeredV padded">' +
              '<img class="icon" src=\'./res/tweetIcon.png\' />' +
              '<div>' +
                '<div class="tweetAuthor" >Stefano Cremona</div>' +
                '<div class="tweetContent" >Non ce la faccio piuuuuuuuuu!! Quando finisce?</div>' +
              '</div>' +
            '</div>' +
          '</div>';
            break;
    }
    document.getElementById("mainPage").innerHTML = innerHTML;
};

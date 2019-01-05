function setUp() {
    document.getElementById("returningUserButton").addEventListener("click", function() {
        const visible = document.getElementById("loginForm").style.visibility;
        let visibility = 'visible';
        console.log('Visibility = ', visible);
        if (visible === 'visible') {
            visibility = 'hidden';
        }
        document.getElementById("loginForm").style.visibility = visibility;
    });
    document.getElementById("loginForm").addEventListener("submit", function() {
        alert('Hello submit');
    });
}
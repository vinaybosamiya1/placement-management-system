<!-- EX - 1 -->
<!-- JSON.stringify() is a JavaScript method that converts JavaScript data into a JSON string. -->
 <script>
const user = {
    name: "Vinayak",
    age: 22,
    skills: ["Vue.js", "PHP"]
}

console.log(user)

const jsonData = JSON.stringify(user)

console.log(jsonData)


// EX - 2 for php
// empty($variable)

// It returns:

// true → variable is empty
// false → variable has a value

// empty("");       // true
// empty(null);     // true
// empty(false);    // true
// empty(0);        // true
// empty("0");      // true
// empty([]);       // true
</script>
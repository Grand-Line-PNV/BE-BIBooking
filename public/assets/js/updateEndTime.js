const start_meeting = document.querySelector("#start_meeting");
const end_meeting = document.querySelector("#end_meeting");
const package = document.querySelector("#package_id");
const FREE_PACKAGE_ID = 1;
const FREE_PACKAGE = 30;
const FEE_PACKAGE = 120;

const pad2 = (n) => {
    return n < 10 ? "0" + n : n;
};

const parseTime = (dateTime) => {
    const date = dateTime,
        ten = (i) => (i < 10 ? "0" : "") + i,
        YYYY = date.getFullYear(),
        MTH = ten(date.getMonth() + 1),
        DAY = ten(date.getDate()),
        HH = ten(date.getHours()),
        MM = ten(date.getMinutes()),
        SS = ten(date.getSeconds());
    return `${YYYY}-${MTH}-${DAY}T${HH}:${MM}:${SS}`;
};
const addMinutes = (minutes, date) => {
    const dateCopy = new Date(date.getTime());
    return dateCopy.setTime(dateCopy.getTime() + minutes * 60 * 1000);
};
const changeTime = () => {
    const start = start_meeting.value;
    if (parseInt(package.value) === FREE_PACKAGE_ID) {
        end_meeting.value = parseTime(
            new Date(addMinutes(FREE_PACKAGE, new Date(start)))
        );
        return;
    }
    end_meeting.value = parseTime(
        new Date(addMinutes(FEE_PACKAGE, new Date(start)))
    );
};

start_meeting.addEventListener("change", changeTime);

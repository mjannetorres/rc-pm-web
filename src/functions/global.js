const getLabel = (status) => {
    if (status == "C") return "Cutting";
    else if (status == "P") return "Printing";
    else if (status == "L") return "Layout";
    else if (status == "B") return "Boxing";
    else if (status == "H") return "Heat Press";
    else if (status == "S") return "Sewing";
    else if (status == "Z") return "Closed";
    else return "Pending";
}
const getColor = (status) => {
    if (status == "C") return "rgb(255, 128, 192)";
    else if (status == "P") return "rgb(0, 255, 255)";
    else if (status == "L") return "green";
    else if (status == "B") return "blue";
    else if (status == "H") return "yellow";
    else if (status == "S") return "rgb(255, 128, 0)";
    else if (status == "Z") return "gray";
    else return "rgb(236, 231, 231)";
}
const currency = (amount) => {
    let number = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "PHP",
    });

    return number.format(amount);
}

export {
    getLabel, getColor, currency
}
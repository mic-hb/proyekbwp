import React from "react";
import { Dropdown, DropdownItem } from "flowbite-react";
export default function dropDown({ header, dropDown }) {
    return (
        <div>
            <p className="font-bold px-2">{header}</p>
            <Dropdown label={header} dismissOnClick={false}>
                {dropDown.map((item, index) => (
                    <DropdownItem key={index}>{item}</DropdownItem>
                ))}
            </Dropdown>
        </div>
    );
}

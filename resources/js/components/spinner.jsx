import React from "react";
import { Spinner } from "flowbite-react";

export default function spinner() {
    return (
        <div className="text-center">
            <Spinner aria-label="Extra large spinner example" size="xl" />
        </div>
    );
}

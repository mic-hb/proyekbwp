import React from "react";

export default function footerCard({ image, link }) {
    return (
        <a
          href={link}
          target="_blank"
        >
            <img
                src={image}
                alt=""
                className="aspect-square w-12 rounded-full object-cover object-top"
            />
        </a>
    );
}

import {
    Footer,
    FooterBrand,
    FooterCopyright,
    FooterDivider,
    FooterIcon,
    FooterLink,
    FooterLinkGroup,
    FooterTitle,
} from "flowbite-react";

import FooterCard from "./footerCard";

export default function footer() {
    return (
        <Footer container>
            <div className="w-full">
                <FooterDivider />
                <div className="w-full sm:flex sm:items-center sm:justify-between">
                    <FooterBrand
                        href="/"
                        src="https://flowbite.com/docs/images/logo.svg"
                        alt="Flowbite Logo"
                        name="NGELAN TOUR"
                    />
                    <div className="mt-4 flex space-x-6 sm:mt-0 sm:justify-center">
                        <FooterCard
                            image={
                                "melvin.jpg"
                            }
                            link={"https://www.instagram.com/melvinn.s22/"}
                        />
                        <FooterCard
                            image={
                                "mb.jpg"
                            }
                            link={"https://www.instagram.com/michael_hamonangan/"}
                        />
                        <FooterCard
                            image={
                                "leon.jpg"
                            }
                            link={"https://www.instagram.com/leonwidjaja_/"}
                        />
                        <FooterCard
                            image={
                                "matthew.jpg"
                            }
                            link={"https://www.instagram.com/rafathew/"}
                        />
                    </div>
                </div>
            </div>
        </Footer>
    );
}

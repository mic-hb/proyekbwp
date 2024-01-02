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
import {
    BsDribbble,
    BsFacebook,
    BsGithub,
    BsInstagram,
    BsTwitter,
} from "react-icons/bs";

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
                                "https://pmb.istts.ac.id/manajemen/_image/calonmhs/223226/223226%20K02.jpg"
                            }
                            link={"https://www.instagram.com/melvinn.s22/"}
                        />
                        <FooterCard
                            image={
                                "https://pmb.istts.ac.id/manajemen/_image/calonmhs/223206/223206%20K02.jpg"
                            }
                            link={"https://www.instagram.com/michael_hamonangan/"}
                        />
                        <FooterCard
                            image={
                                "https://pmb.istts.ac.id/manajemen/_image/calonmhs/223120/223120%20K02.jpg"
                            }
                            link={"https://www.instagram.com/leonwidjaja_/"}
                        />
                        <FooterCard
                            image={
                                "https://pmb.istts.ac.id/manajemen/_image/calonmhs/223010/223010%20K02.jpg"
                            }
                            link={"https://www.instagram.com/rafathew/"}
                        />
                    </div>
                </div>
            </div>
        </Footer>
    );
}

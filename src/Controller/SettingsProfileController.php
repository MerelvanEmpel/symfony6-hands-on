<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Form\UserProfileType;
use App\Form\ProfileImageType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

final class SettingsProfileController extends AbstractController
{
    #[Route('/settings/profile', name: 'app_settings_profile')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function profile(Request $request, UserRepository $users): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $userProfile = $user->getUserProfile() ?? new UserProfile();

        $form = $this->createForm(UserProfileType::class, $userProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userProfile = $form->getData();
            $user->setUserProfile($userProfile);
            $users->add($user, true);
            $this->addFlash('success', 'Your user profile settings were saved.');

            return $this->redirectToRoute('app_settings_profile');
        }

        return $this->render('settings_profile/profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/settings/profile-image', name: 'app_settings_profile_image')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function profileImage(Request $request, SluggerInterface $slugger, UserRepository $users): Response {
        $form = $this->createForm(ProfileImageType::class);
        /** @var User $user */
        $user = $this->getUser();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $profileImageFile */
            $profileImageFile = $form->get('profileImage')->getData();
            if ($profileImageFile) {
                $originalFileName = pathInfo($profileImageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $saveFileName = $slugger->slug($originalFileName);
                $newFileName = $saveFileName . '-' . uniqid() . '.' . $profileImageFile->guessExtension();
            }

            try {
                $profileImageFile->move(
                    $this->getParameter('profiles_directory'),
                    $newFileName
                );
            } catch (FileException $e) {
            }

            $profile = $user->getUserProfile() ?? new UserProfile();
            $user->setUserProfile($profile);
            $profile->setImage($newFileName);
            $users->add($user, true);
            $this->addFlash('success', 'Your profile image was updated.');

            return $this->redirectToRoute('app_settings_profile_image');
        }

        return $this->render('settings_profile/profile_image.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

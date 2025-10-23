package com.grupok.watertrack.fragments.alertDialogFragments;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.fragment.app.Fragment;

import com.grupok.watertrack.R;
import com.grupok.watertrack.databinding.FragmentAlertDialogQuestionBinding;

public class AlertDialogQuestionFragment extends Fragment {

    private ConfirmButtonClickQuestionDialog listenner;
    private CancelButtonClickQuestionDialog cancelListenner;
    public interface ConfirmButtonClickQuestionDialog{
        void onConfirmButtonClickedQuestionDialog();
    }
    public interface CancelButtonClickQuestionDialog{
        void onCancelButtonClickedQuestionDialog();
    }
    private FragmentAlertDialogQuestionBinding binding;
    private String title, description, Style;


    public AlertDialogQuestionFragment() {

    }
    public AlertDialogQuestionFragment(String title, String description, ConfirmButtonClickQuestionDialog listenner, CancelButtonClickQuestionDialog cancelListenner, String Style) {
        this.title = title;
        this.description = description;
        this.listenner = listenner;
        this.cancelListenner = cancelListenner;
        this.Style = Style;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentAlertDialogQuestionBinding.inflate(inflater);

        binding.textViewTitleAlertDialogFragmentQuestion.setText(title);
        binding.textViewDescriptionAlertDialogFragmentQuestion.setText(description);

        switch (Style){
            case "2":
                binding.buttonCancelAlertDialogFragmentQuestion.setText(getString(R.string.general_cancel));
                binding.buttonConfirmAlertDialogFragmentQuestion.setText(getString(R.string.general_confirm));
                break;
            case "3":
                binding.buttonCancelAlertDialogFragmentQuestion.setText(getString(R.string.general_dontSave));
                binding.buttonConfirmAlertDialogFragmentQuestion.setText(getString(R.string.general_save));
                break;
            case "4":
                binding.buttonCancelAlertDialogFragmentQuestion.setText(getString(R.string.general_no));
                binding.buttonConfirmAlertDialogFragmentQuestion.setText(getString(R.string.general_yes));
                break;
        }

        binding.buttonConfirmAlertDialogFragmentQuestion.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                listenner.onConfirmButtonClickedQuestionDialog();
            }
        });

        binding.buttonCancelAlertDialogFragmentQuestion.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                cancelListenner.onCancelButtonClickedQuestionDialog();
            }
        });

        return binding.getRoot();
    }
}